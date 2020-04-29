jQuery(document).ready(function () {
        var canvas = this.__canvas = new fabric.Canvas('canvas');

        //Replace olde image by new image
        jQuery('#span').on('change',function (e) {
            var obj_id = jQuery(this).data('id');
            var file = e.target.files[0];
            var reader = new FileReader();
            reader.onload = function(file) {
                replaceImage(file.target.result,obj_id);
            }
            reader.readAsDataURL(file);
        });

        function replaceImage(imgLink,obj_id) {
            fabric.Image.fromURL(imgLink, function(img) {
                img.set({ 'left': 0 });
                img.set({ 'top': 0 });
                img.scaleToWidth(100);
                img.scaleToHeight(100);

                var objs = canvas.getObjects();
                if (objs.length) {
                    var i = 0;
                    objs.forEach(function(e) {
                        if (e.id && e.id === obj_id) {
                            canvas.remove(objs[i]);
                            img.scale(0.5);
                            img.originX = 'center';
                            img.originY = 'center';
                            canvas.centerObject(img);
                            img.set({ left: 612, top: 222, angle: 15,id: obj_id});
                            canvas.add(img);
                            canvas.renderAll();
                        }
                        i++;
                    });
                } else canvas.add(img);
            });
        }

        //Change color of the image in the canvas
        jQuery('ul.byd-color-list li input').click(function(e)
        {
            var id = jQuery(this).data('id');
            var color = jQuery(this).data('color');
            var objs = canvas.getObjects();
            if (objs.length) {
                var i = 0;
                objs.forEach(function(e) {
                    if (e.id && e.id === id) {
                        var obj = objs[i].scale(0.5);
                        obj.set({ left: 612, top: 222, angle: 15, fill:color});
                        canvas.renderAll();
                    }
                    i++;
                });
            }
        });


        //Add new Image
        function addNewImage(imgLink) {
            fabric.Image.fromURL(imgLink, function(img) {
                img.set({ 'left': 50 });
                img.set({ 'top': 50 });
                img.scaleToWidth(100);
                img.scaleToHeight(100);
                canvas.add(img);
            });
        }

        var span = document.querySelector('#add-file');
        span.onchange = function(e) {
            var file = e.target.files[0];
            var reader = new FileReader();
            reader.onload = function(file) {
                addNewImage(file.target.result);
            }
            reader.readAsDataURL(file);
        };
        // End Adding new image


        //Import images from SVG file
        var import_btn = document.querySelector('#import-svg');
        import_btn.onchange = function(e) {
            var file = e.target.files[0];
            var reader = new FileReader();
            reader.onload = function(file) {
                importFromSVG(file.target.result);
            }
            reader.readAsDataURL(file);
        };

        function importFromSVG(url) {
            fabric.loadSVGFromURL(url, function(objects, options) {
                console.log("test");
                console.log(objects);
                var i;
                objects.forEach(function(svg) {
                    var tmp_id = 'canvas_'+i;
                    if(typeof svg.id ==='undefined'){
                        svg.set('id',tmp_id);
                    }
                    canvas.add(svg).renderAll();
                    i++;

                });
            });
        }

        //Import images from SVG file
        jQuery('#save-svg').on('click',function () {
            var canvas_data = canvas.toSVG();
            jQuery.ajax({
                url:'actions/save_data.php',
                method: "POST",
                data:{canvas:canvas_data},
                dataType: "text",
                success:function (res) {
                    console.log("test");
                    console.log(res);
                }
            })
        });
    });