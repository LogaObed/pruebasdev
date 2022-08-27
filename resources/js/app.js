import Dropzone from "dropzone";
if (document.getElementById('dropzone')) {
    // no buscar esta calse
    Dropzone.autoDiscover = false;
    // configuracion Dropzone
    const dropzone = new Dropzone("#dropzone", {
        dictDefaultMessage: "Sube aqui tu foto",
        acceptedFiles: ".png,.jpg,.jpeg,.gif",
        addRemoveLinks: true,
        dictRemoveFile: "Borrer Archivo",
        maxFiles: 1,
        uploadMultiple: false,
        init: function () {
            if (document.getElementById("imagen").value.trim()) {
                const imagenP = {};
                imagenP.size = 1234;
                imagenP.name = document.getElementById("imagen").value;
                this.options.addedfile.call(this, imagenP);
                this.options.thumbnail.call(this, imagenP, `/uploads/${imagenP.name}`);
                imagenP.previewElement.classList.add(
                    "dz-success",
                    "dz-complete"
                );
            }
        },
    });
    // validaciones de dropzone
    dropzone.on('success', function (file, response) {
        console.log(response.imgen);
        document.getElementById("imagen").value = response.imgen;
    });
    dropzone.on('error', function (file, message) {
        console.log(message);
    });

    dropzone.on('removedfile', function () {
        console.log("archivo eliminaod");
    });

}
