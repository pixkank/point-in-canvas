<div>
    <div class="grid grid-cols-2 gap-2">
        <div>
            <p>tWidth : {{ (int)$template_detail['tWidth'] ?? 'None' }}</p>
            <p>tHeight : {{ (int)$template_detail['tHeight'] ?? 'None' }}</p>
        </div>
        <div>
            <p>cWidth : {{ (int)$template_detail['cWidth'] ?? 'None' }}</p>
            <p>cWidth : {{ isset($template_detail['cHeight']) ? (int)$template_detail['cHeight'] ?? 'None' : 'None' }}</p>
        </div>
    </div>

    <div class="flex justify-center">
        <canvas id="the-canvas" class="border-2 border-sky-500 dropzone" wire:ignore></canvas>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>

    <script>
        var loadingTask = pdfjsLib.getDocument("{{ asset($file_path) }}");

        loadingTask.promise.then(function(pdf) {
            pdf.getPage(1).then(function(page) {
                // คำนวณสัดส่วน
                var scale = {{ $cWidth }} / page.getViewport({ scale: 1.0 }).width;
                // var widthScale = {{ $template_detail['tWidth'] }} / page.getViewport({ scale: 1.0 }).width;
                // var heightScale = {{ $template_detail['tHeight'] }} / page.getViewport({ scale: 1.0 }).height;


                // ใช้ค่า scale น้อยสุดเพื่อให้แน่ใจว่าภาพจะไม่บิดเบี้ยว
                // var scale = Math.min(widthScale, heightScale);
                
                console.log('scale : '+scale);
                // console.log('widthScale : '+widthScale);
                // console.log('heightScale : '+heightScale);
                
                var viewport = page.getViewport({
                    scale: scale,
                });


                var canvas = document.getElementById('the-canvas');
                var context = canvas.getContext('2d');

                canvas.width = Math.floor(viewport.width);
                canvas.height = Math.floor(viewport.height);
                @this.set_cHeight(canvas.height);

                canvas.style.width = Math.floor(viewport.width) + "px";
                canvas.style.height = Math.floor(viewport.height) + "px";
                console.log("viewport height : "+viewport.height);
                console.log("t height : "+({{ $template_detail['tHeight'] }}));

                var renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                page.render(renderContext);
            });
        });
    </script>
</div>
