import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Sube aquí tu imágen",
    acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
    addRemoveLinks: true,
    dictRemoveFile: "Eliminar",
    maxFiles: 1,
    uploadMultiple: false,

    init: function () {
        if (document.querySelector('[name="image"]').value.trim()) {
            const imagePublish = {};
            imagePublish.size = 1234;
            imagePublish.name = document.querySelector('[name="image"]').value;

            this.options.addedfile.call(this, imagePublish);
            this.options.thumbnail.call(this, imagePublish, `/uploads/${imagePublish.name}`);
            imagePublish.previewElement.classList.add('dz-success', 'dz-complete');
        }
    }
});

//Eventos Dropzone

dropzone.on('sending', function (file, xhr, formData) {

});

dropzone.on('success', function (file, response) {
    console.log(response);
    document.querySelector('[name="image"]').value = response.image;

});

dropzone.on('error', function (file, response) {

});

//Eliminar la imagen
dropzone.on('removedfile', function (file, response) {
    document.querySelector('[name="image"]').value = "";
});
