window.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('input[type="file"]').forEach(el=>{
        if(el.dataset.preview) {
            const previewEl = document.getElementById(el.dataset.preview);
            if(!previewEl) return;

            el.addEventListener('change', function (evt) {
                var tgt = evt.target || window.event.srcElement,
                    files = tgt.files;
            
                // FileReader support
                if (FileReader && files && files.length) {
                    var fr = new FileReader();
                    fr.onload = function () {
                        previewEl.src = fr.result;
                    }
                    fr.readAsDataURL(files[0]);
                }
            
                // Not supported
                else {
                    // fallback -- perhaps submit the input to an iframe and temporarily store
                    // them on the server until the user's session ends.
                }
            })
        }
    })
})