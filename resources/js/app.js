// If you are using JavaScript/ECMAScript modules:
import Dropzone from "dropzone";

// If you are using an older version than Dropzone 6.0.0,
// then you need to disabled the autoDiscover behaviour here:
Dropzone.autoDiscover = false;

let dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: `<span class="text-gray-300 text-md text-center font-bold uppercase">Arrastra archivo o haz click para subir imagen...</span>`,
    acceptedFiles: '.jpg, .jpeg, .png, .gif',
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar imagen',
    maxFiles: 1,
    uploadMultiple: false,

    //se ejecuta al crearse la instancia de dropzone
    init: function() {
        if( document.querySelector('input[name="imagen"]').value.trim() ) {
            const imagenPublicada = {};
            imagenPublicada.size = 1;
            imagenPublicada.name = document.querySelector('input[name="imagen"]').value.trim();

            this.options.addedfile.call(this, imagenPublicada);
            
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);

            //agregar las clases de dropzone
            imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');
        }
    }
});

// dropzone.on("addedfile", function(file) {
//     console.log(`Archivo: ${file.name} agregado`);    
// });

// dropzone.on('sending', function(file, xhr, formData) {
//     console.log(formData);
// });

dropzone.on('success', function(file, response) {
    //agregar el nombre de la imagen al input hidden
    document.querySelector('input[name="imagen"]').value = response.imagen;
});

dropzone.on('error', function(file, message) {
    console.log(message);
});

dropzone.on('removedfile', function() {
    //eliminar la imagen del value
    document.querySelector('input[name="imagen"]').value = '';
});