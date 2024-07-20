<div>
    <div>Position X : {{ $positionX ?? 'None' }}</div>
    <div>Position Y : {{ $positionY ?? 'None' }}</div>
    <div class="draggable bg-lime-500 w-fit" wire:ignore> Draggable Element </div>

    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
    <script>
        var tWidth, tHeight;
        var cWidth, cHeight;
        document.addEventListener('livewire:init', () => {
            Livewire.on('template_detail', data => {
                processData(data[0]);
            });
        });

        function processData(data) {
            tWidth = data.tWidth
            cWidth = data.cWidth

            tHeight = data.tHeight
            cHeight = data.cHeight
        }

        interact('.dropzone').dropzone({
            accept: '.draggable',
            ondrop: function(event) {
                var draggableElement = event.relatedTarget;
                var dropzoneElement = event.target
                var rect1 = draggableElement.getBoundingClientRect();
                var rect2 = dropzoneElement.getBoundingClientRect();
                var x = rect1.left - rect2.left;
                var y = rect1.top - rect2.top;

                if (tHeight) {
                    x = (tWidth/cWidth)*x
                    y = (tHeight/cHeight)*y
                }
                @this.set_position(parseInt(x), parseInt(y));
            },
        });

        interact('.draggable').draggable({
            listeners: {
                move: dragMoveListener,
            }
        });

        function dragMoveListener(event) {
            var target = event.target;
            // keep the dragged position in the data-x/data-y attributes
            var x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
            var y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

            // translate the element
            target.style.transform = 'translate(' + x + 'px, ' + y + 'px)';

            // update the posiion attributes
            target.setAttribute('data-x', x);
            target.setAttribute('data-y', y);
        };

        // this function is used later in the resizing and gesture demos
        window.dragMoveListener = dragMoveListener;
    </script>
</div>
