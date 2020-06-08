/**
 * Implementacion de un servidor REST , nodejs.
 * Listar, agregar, actualizar y eliminar usuarios
 * 
 */

const express = require( 'express' );
const bodyParser = require( 'body-parser' );
const app = express();

app.use( bodyParser.urlencoded( {extended: true } ) );
app.use( bodyParser.json() );


let usuarios = [];  // Lista de usuarios.
let indice = 0;     // Indice contador para id de usuarios.

let respuesta = {
    error: false,
    codigo: 200,
    mensaje: ''
}

// get default
app.get( '/', ( req,res )  => {
    respuesta = {
        error: true,
        codigo: 200,
        mensaje: 'punto de inicio'
    }
    res.send( respuesta );
});

// Router GET, POST
app.route( '/usuarios' )
    .get( (req,res ) => { // get usuarios: recupera el listado de todos los usuarios
        respuesta = {
            error: false,
            codigo: 200,
            mensaje: 'listado de usuarios',
            respuesta: usuarios
        };
        res.send( respuesta );
    })
    .post( ( req,res ) => { // post usuario: agrega un nuevo  usuario con sus datos
        if (!req.body.nombre || !req.body.apellido) { 
            respuesta = {
                error: true,
                codigo: 502,
                mensaje: 'El campo nombre y apellido son requeridos'
            };
        }
        else {
            let usr = usuarios.find( usuario => (usuario.nombre === req.body.nombre && usuario.apellido === req.body.apellido) );
            if (usr) {
                respuesta = {
                    error: true,
                    codigo: 503,
                    mensaje: 'El usuario ya fue creado previamente'
                };
            }
            else {
                let newUsuario = {
                    id: ++indice,
                    nombre: req.body.nombre,
                    apellido: req.body.apellido
                }
                usuarios.push( newUsuario );
                respuesta = {
                    error: false,
                    codigo: 200,
                    mensaje: 'Usuario creado',
                    respuesta: newUsuario
                };
            }
        }
        res.send( respuesta );
    });

// Router GET, PUT, DELETE
app.route( '/usuarios/:id')
    .get( ( req,res ) => { // Recupera el usuario con id especifico
        let usr = usuarios.find( usuario => (usuario.id == req.params.id) );
        if (!usr) {
            respuesta = {
                error: true,
                codigo: 501,
                mensaje: 'El usuario con id ' + req.params.id + ' no existe'
            }
        }
        else {
            respuesta = {
                error: false,
                codigo: 200,
                mensaje: 'usuario encontrado',
                respuesta: usr
            }
        }
        res.send( respuesta );
    })
    .put( (req,res) => {// put usuario: modifica datos del usuario con el id  
        let usr = usuarios.find( usuario => usuario.id == req.params.id );
        if (!usr) {
            respuesta = {
                error: true,
                codigo: 501,
                mensaje: 'El usuario con id ' + req.params.id + ' no existe'
            }
        }
        else if (!req.body.nombre || !req.body.apellido) {
            respuesta = {
                error: true,
                codigo: 502,
                mensaje: 'El campo nombre y apellido son requeridos'
            };
        }
        else if (usuarios.find( usuario => usuario.id != req.params.id && (usuario.nombre === req.body.nombre && usuario.apellido === req.body.apellido))) {
            respuesta = {
                error: true,
                codigo: 503,
                mensaje: 'Existe otro usuario con igual nombre y apellido'
            };
        }
        else {
            usr.nombre = req.body.nombre;
            usr.apellido = req.body.apellido;
            respuesta = {
                error: false,
                codigo: 200,
                mensaje: 'Usuario actualizado',
                respuesta: usr
            };
        }
        res.send( respuesta );
    })
    .delete( (req,res) => { // delete usuario: elimina un usuario por su id.
        let usr = usuarios.find( usuario => usuario.id == req.params.id );
        if (!usr) {
            respuesta = {
                error: true,
                codigo: 501,
                mensaje: 'El usuario con id ' + req.params.id + ' no existe'
            }
        }
        let i = usuarios.indexOf( usr );
        if (i !== -1) 
            usuarios.splice( i,1 );
        respuesta = {
            error: false,
            codigo: 200,
            mensaje: 'Usuario eliminado',
            respuesta: usr
        };
        res.send( respuesta );
    });

app.use( function( req,res,next ) {
    respuesta = {
        error: true,
        codigo: 404,
        mensaje: 'URL no encontrada'
    };
    res.status( 404 ).send( respuesta );
});

// servidor escucha en el puerto 3000.
PORT = 3000;
app.listen( PORT, () => {
    console.log( "Servidor NodeJS http://localhost:" + PORT );
});