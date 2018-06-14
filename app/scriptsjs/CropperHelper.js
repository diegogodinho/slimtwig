function CropperHelper() {

    var _defaults = {
        multiple: true,
        IDFileInput: "inputImage",
        IDIMGPrincipal: "imgprincipal",
        IDModalCropper: "#modalCropper",
        IDIMGExterno: "#imgExterna",
        IDFieldToSetIDFoto: "#IDFoto",
        ErrorLoadImage: "Por favor selecione uma imagem",

        //Cropper Options
        options: {
            toggleDragModeOnDblclick: false,
            cropBoxResizable: false,
            movable: false,
            rotatable: false,
            scalable: false,
            zoomable: false,
            zoomOnTouch: false,
            zoomOnWheel: false,
            aspectRatio: 1 / 1,
            preview: '.img-preview',
            build: function () {
                //console.log('build');
            },
            built: function () {
                //console.log('built');
            },
            cropstart: function (data) {
                //console.log('cropstart', data.action);
            },
            cropmove: function (data) {
                //console.log('cropmove', data.action);
            },
            cropend: function (data) {
                //console.log('cropend', data.action);
            },
            crop: function (data) {
                //console.log('crop');
                EixoX.val(Math.round(data.x));
                EixoY.val(Math.round(data.y));
                Altura.val(Math.round(data.height));
                Largura.val(Math.round(data.width));
            },
            zoom: function (data) {
                //console.log('zoom', data.ratio);
            }
        }

    };

    var EixoX = $(_defaults.IDModalCropper + " #EixoX");
    var EixoY = $(_defaults.IDModalCropper + " #EixoY");
    var Altura = $(_defaults.IDModalCropper + " #Altura");
    var Largura = $(_defaults.IDModalCropper + " #Largura");

    function LoadImage(data) {

        $.extend(true, _defaults, data);

        var inputImage = document.getElementById(_defaults.IDFileInput);

        var imgprincipal = document.getElementById(_defaults.IDIMGPrincipal);

        var cropper = new Cropper(imgprincipal, _defaults.options);

        var URL = window.URL || window.webkitURL;

        var blobURL;

        var file;

        $(_defaults.IDModalCropper).on('shown.bs.modal', function (e) {
            cropper.replace(blobURL);
            cropper.zoomTo(1);
        });

        $(_defaults.IDModalCropper + " #salveFoto").click(function () {
            $(_defaults.IDModalCropper).modal('hide');
            $(_defaults.IDModalCropper + " #formUploadImagem").unbind('submit').on('submit', (function (e) {                
                e.preventDefault();
                if (window.FormData) {

                    var formData = new FormData();
                    formData.append("foto", file);
                    formData.append("EixoX", EixoX.val());
                    formData.append("EixoY", EixoY.val());
                    formData.append("Altura", Altura.val());
                    formData.append("Largura", Largura.val());
                    debugger;

                    $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'),
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            debugger;
                            $(_defaults.IDIMGExterno).attr('src', data.urlrelative);
                            $(_defaults.IDFieldToSetIDFoto).val(data.id);
                        },
                        error: function (data) {
                            //console.log("error");
                            console.log(data);
                        }
                    });
                    return false;
                }
            }));
            $(_defaults.IDModalCropper + " #formUploadImagem").submit();
        });


        if (URL) {
            inputImage.onchange = function () {
                var files = this.files;
                if (cropper && files && files.length) {
                    file = files[0];

                    if (/^image\/\w+/.test(file.type)) {
                        blobURL = URL.createObjectURL(file);
                        $(_defaults.IDModalCropper).modal('show');
                        inputImage.value = null;
                    } else {
                        window.alert(_defaults.ErrorLoadImage);
                    }
                }
            };
        } else {
            inputImage.disabled = true;
            inputImage.parentNode.className += ' disabled';
        }
    };

    return {
        LoadImage: LoadImage
    };

}