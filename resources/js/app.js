import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube una imagen aqui',
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar archivo',
    maxFiles: 1,
    upploadMultiple: false,
    // chunking: true,
    // forceChunking: true,
    // chunkSize: 2000000,

    init: function() {
        if(document.querySelector('[name="imagen"]').value.trim()) {
            const imagenSubida = {};
            imagenSubida.size = 8192; //puede ser cualquier valor
            imagenSubida.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this, imagenSubida);
            this.options.thumbnail.call(this, imagenSubida, `/uploads/${imagenSubida.name}`);

            imagenSubida.previewElement.classList.add('dz-success', 'dz-complete');
        }
    }

});


dropzone.on('sending', function(file, xhr, formData) {
    // console.log(file);
    // console.log(xhr);
    // console.log(formData);
});

dropzone.on('success', function(file, response) {
    // console.log(file);
    console.log(response.imagen);
    document.querySelector('[name="imagen"]').value = response.imagen;
});

dropzone.on('error', function(message) {
    console.log(message);
});

dropzone.on('removedfile', function() {
    //borrar el value de la imagen
    document.querySelector('[name="imagen"]').value = '';
});