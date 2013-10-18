function iniciar(){
cajadatos=document.getElementById('cajadatos');
var boton=document.getElementById('grabar');
boton.addEventListener('click', agregarobjeto, false);

if('webkitIndexedDB' in window){
window.indexedDB=window.webkitIndexedDB;
window.IDBTransaction=window.webkitIDBTransaction;
window.IDBKeyRange=window.webkitIDBKeyRange;
window.IDBCursor=window.webkitIDBCursor;
}else if('mozIndexedDB' in window){
window.indexedDB=window.mozIndexedDB;
}

var solicitud=indexedDB.open('mibase');
solicitud.addEventListener('error', errores, false);
solicitud.addEventListener('success', crear, false);
}
function errores(e){
alert('Error: '+e.code+' '+e.message);
} function crear(e){
bd=e.result || e.target.result;
if(bd.version==''){
var solicitud=bd.setVersion('1.0');
solicitud.addEventListener('error', errores, false);
solicitud.addEventListener('success', crearbd, false);
}
}
function crearbd(){
var almacen=bd.createObjectStore('peliculas',{keyPath:'id'});
almacen.createIndex('BuscarFecha', 'fecha',{unique: false});
}
function agregarobjeto(){
var clave=document.getElementById('clave').value;
var titulo=document.getElementById('texto').value;
var fecha=document.getElementById('fecha').value;
var transaccion=bd.transaction(['peliculas'],IDBTransaction.READ_WRITE);
var almacen=transaccion.objectStore('peliculas');
var solicitud=almacen.add({id: clave, nombre: titulo, fecha:fecha});
solicitud.addEventListener('success', function(){mostrar(clave)}, false);
document.getElementById('clave').value='';
document.getElementById('texto').value='';
document.getElementById('fecha').value='';
}
function mostrar(clave){
var transaccion=bd.transaction(['peliculas']);
var almacen=transaccion.objectStore('peliculas');
var solicitud=almacen.get(clave);
solicitud.addEventListener('success', mostrarlista, false);
} function mostrarlista(e){
var resultado=e.result || e.target.result;
cajadatos.innerHTML='<div>'+resultado.id+' - '+resultado.nombre+' - '+resultado.fecha+'</div>';
}
window.addEventListener('load', iniciar, false);
