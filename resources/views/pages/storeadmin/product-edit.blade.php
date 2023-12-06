@extends('layouts.admin-layout', ['title' => 'Kyroshopu | Edit Product'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'User Management'])
<div class="container-fluid py-4">
    <form action="{{ route('store.product.update', explode('-', $product->product_id)[1]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mt-4">
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="font-weight-bolder">Product Image</h5>
                        <div class="row">
                            <div class="col-12">
                                <img class="w-100 border-radius-lg shadow-lg mt-3" id="avatar" src="{{ asset('images/' . $product->image) }}" alt="product_image">
                            </div>
                            <div class="col-12 mt-5">
                                <div class="d-flex">
                                    <button class="btn btn-primary btn-sm mb-0 me-2" type="button" name="button" onclick="$('#input').click()">Edit</button>
                                    <input style="display:none" type="file" id="input" name="image" accept="image/*">
                                    <button class="btn btn-outline-dark btn-sm mb-0" type="button" name="button">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mt-lg-0 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="font-weight-bolder">Product Information</h5>
                        <div class="row">
                            <div class="col-12 col-sm-7">
                                <label>Name</label>
                                <input class="form-control" name="product_name" type="text" value="{{ $product->product_name }}" onfocus="focused(this)" onfocusout="defocused(this)">
                            </div>
                            <div class="col-12 col-sm-5">
                                <label class="">Collection</label>
                                <input class="form-control" name="description" type="text" value="Summer" onfocus="focused(this)" onfocusout="defocused(this)">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="mt-4">Description</label>
                                <textarea class="form-control" name="description" rows="5">{{ $product->description }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <!-- <div class="row"> -->
                        <label for="multiple-select-field">Categories</label>
                        <select name="category[]" class="form-select" id="multiple-select-field" data-placeholder="Choose anything" multiple>
                            @foreach ($categories as $category)
                            <option value="{{ $category->category_id }}" 
                            @if (in_array($category->category_id, $selectedCat))
                            selected=selected
                            @endif
                            > {{ $category->category_name }}</option>
                                @endforeach
                        </select>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
            <div class="col-sm-8 mt-sm-0 mt-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <h5 class="font-weight-bolder">Variants</h5>
                            </div>
                            <div class="col-4">
                                <div class="input-group text-sm">
                                    <span class="input-group-text">#</span>
                                    <input type="text" class="form-control" id="variant-qty" placeholder="Amount">
                                    <button class="btn btn-primary mb-0" onclick="addFields()" type="button" id="button-addon1">+</button>
                                </div>
                            </div>
                        </div>
                        @foreach($product->product_variant as $variant)
                        <div class="row">
                            <div class="col-9">
                                <label class="mt-4">Variant Name</label>
                                <input class="form-control" value="{{$variant->variant_name}}" type="text" name="oldname[]" onfocus="focused(this)" onfocusout="defocused(this)">
                            </div>
                            <div class="col-3">
                                <label class="mt-4">Weight</label>
                                <input class="form-control" value="{{$variant->weight}}" type="number" name="oldweight[]" onfocus="focused(this)" onfocusout="defocused(this)">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label>Price</label>
                                <input class="form-control" value="{{$variant->price}}" type="number" name="oldprice[]" onfocus="focused(this)" onfocusout="defocused(this)">
                            </div>
                            <div class="col-4">
                                <label>Stock</label>
                                <input class="form-control" value="{{$variant->stock}}" type="number" name="oldstock[]" onfocus="focused(this)" onfocusout="defocused(this)">
                            </div>
                            <div class="col-5">
                                <label>SKU</label>
                                <input class="form-control" value="{{$variant->variant_id}}" type="text" name="oldsku[]" onfocus="focused(this)" onfocusout="defocused(this)" readonly>
                            </div>
                        </div>
                        @endforeach
                        <div id="variants">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-5">
                <button class="btn btn-primary mb-0 mt-lg-auto w-100" type="submit" name="button">Add to cart</button>
            </div>
        </div>
    </form>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Crop the image</h5>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer pt-3  ">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="copyright text-center text-sm text-muted text-lg-start">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>2023,
                        made with <i class="fa fa-heart" aria-hidden="true"></i> by
                        <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                        &amp;
                        <a href="https://www.updivision.com" class="font-weight-bold" target="_blank">UPDIVISION</a>
                        for a better web.
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                        <li class="nav-item">
                            <a href="https://www.updivision.com" class="nav-link text-muted" target="_blank">UPDIVISION</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>
<script>
    window.addEventListener('DOMContentLoaded', function() {
        var avatar = document.getElementById('avatar');
        var image = document.getElementById('image');
        var input = document.getElementById('input');
        var $alert = $('.alert');
        var $modal = $('#modal');
        var cropper;

        $('[data-toggle="tooltip"]').tooltip();

        input.addEventListener('change', function(e) {
            var files = e.target.files;
            var done = function(url) {
                input.value = '';
                image.src = url;
                $alert.hide();
                $modal.modal('show');
            };
            var reader;
            var file;
            var url;

            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 2,
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        document.getElementById('crop').addEventListener('click', function() {
            var initialAvatarURL;
            var canvas;

            $modal.modal('hide');

            if (cropper) {
                canvas = cropper.getCroppedCanvas({
                    width: 640,
                    height: 640,
                });
                initialAvatarURL = avatar.src;
                avatar.src = canvas.toDataURL();
                $alert.removeClass('alert-success alert-warning');
                canvas.toBlob(function(blob) {
                    var formData = new FormData();
                    let container = new DataTransfer();

                    let file = new File([blob], "fileimage.jpg", {
                        type: "image/jpeg",
                        lastModified: new Date().getTime()
                    });
                    container.items.add(file);
                    input.files = container.files;
                    formData.append('avatar', blob, 'avatar.jpg');
                    // $.ajax('https://jsonplaceholder.typicode.com/posts', {
                    //   method: 'POST',
                    //   data: formData,
                    //   processData: false,
                    //   contentType: false,

                    //   xhr: function () {
                    //     var xhr = new XMLHttpRequest();

                    //     xhr.upload.onprogress = function (e) {
                    //       var percent = '0';
                    //       var percentage = '0%';

                    //       if (e.lengthComputable) {
                    //         percent = Math.round((e.loaded / e.total) * 100);
                    //         percentage = percent + '%';
                    //         $progressBar.width(percentage).attr('aria-valuenow', percent).text(percentage);
                    //       }
                    //     };

                    //     return xhr;
                    //   },

                    //   success: function () {
                    //     $alert.show().addClass('alert-success').text('Upload success');
                    //   },

                    //   error: function () {
                    //     avatar.src = initialAvatarURL;
                    //     $alert.show().addClass('alert-warning').text('Upload error');
                    //   },

                    //   complete: function () {
                    //     $progress.hide();
                    //   },
                    // });
                });
            }
        });
    });
</script>
<script>
    $('#multiple-select-field').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        closeOnSelect: false,
    });
</script>
<script type='text/javascript'>
    function addFields() {
        // Generate a dynamic number of inputs
        var number = document.getElementById("variant-qty").value;
        // Get the element where the inputs will be added to
        var container = document.getElementById("variants");
        // Remove every children it had before
        while (container.hasChildNodes()) {
            container.removeChild(container.lastChild);
        }
        for (i = 0; i < number; i++) {
            container.appendChild(document.createElement("hr"));
            var row = document.createElement("div");
            row.classList.add("row");
            var col = document.createElement("div");
            col.classList.add("col-9");
            var label_name = document.createElement("label");
            label_name.classList.add("mt-0");
            label_name.innerHTML = "Variant Name";
            var input_name = document.createElement("input");
            input_name.classList.add("form-control");
            input_name.type = "text";
            input_name.name = "name[]";
            input_name.setAttribute("onfocus", "focused(this)");
            input_name.setAttribute("onfocusout", "defocused(this)");
            col.appendChild(label_name)
            col.appendChild(input_name)
            row.appendChild(col)

            var col = document.createElement("div");
            col.classList.add("col-3");
            var label_weight = document.createElement("label");
            label_weight.classList.add("mt-0");
            label_weight.innerHTML = "Weight";
            var input_weight = document.createElement("input");
            input_weight.classList.add("form-control");
            input_weight.type = "number";
            input_weight.name = "weight[]";
            input_weight.setAttribute("onfocus", "focused(this)");
            input_weight.setAttribute("onfocusout", "defocused(this)");
            col.appendChild(label_weight)
            col.appendChild(input_weight)
            row.appendChild(col)

            container.appendChild(row)
            // Append a line break 
            var row = document.createElement("div");
            row.classList.add("row");
            var col = document.createElement("div");
            col.classList.add("col-3");
            var label_price = document.createElement("label");
            label_price.classList.add("mt-0");
            label_price.innerHTML = "Price";
            var input_price = document.createElement("input");
            input_price.classList.add("form-control");
            input_price.type = "number";
            input_price.name = "price[]";
            input_price.setAttribute("onfocus", "focused(this)");
            input_price.setAttribute("onfocusout", "defocused(this)");
            col.appendChild(label_price)
            col.appendChild(input_price)
            row.appendChild(col)

            var col = document.createElement("div");
            col.classList.add("col-4");
            var label_stock = document.createElement("label");
            label_stock.classList.add("mt-0");
            label_stock.innerHTML = "Stock";
            var input_stock = document.createElement("input");
            input_stock.classList.add("form-control");
            input_stock.type = "number";
            input_stock.name = "stock[]";
            input_stock.setAttribute("onfocus", "focused(this)");
            input_stock.setAttribute("onfocusout", "defocused(this)");
            col.appendChild(label_stock)
            col.appendChild(input_stock)
            row.appendChild(col)

            var col = document.createElement("div");
            col.classList.add("col-5");
            var label_sku = document.createElement("label");
            label_sku.classList.add("mt-0");
            label_sku.innerHTML = "SKU";
            var input_sku = document.createElement("input");
            input_sku.classList.add("form-control");
            input_sku.type = "text";
            input_sku.name = "sku[]";
            input_sku.setAttribute("onfocus", "focused(this)");
            input_sku.setAttribute("onfocusout", "defocused(this)");
            col.appendChild(label_sku)
            col.appendChild(input_sku)
            row.appendChild(col)
            container.appendChild(row)
        }
    }
</script>
@endsection