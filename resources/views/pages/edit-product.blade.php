@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'User Management'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-6">
            <h4 class="text-white">Make the changes below</h4>
            <p class="text-white opacity-8">We’re constantly trying to express ourselves and actualize our dreams. If
                you have the opportunity to play.</p>
        </div>
        <div class="col-lg-6 text-right d-flex flex-column justify-content-center">
            <button type="button" class="btn btn-outline-white mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2">Save</button>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="font-weight-bolder">Product Image</h5>
                    <div class="row">
                        <div class="col-12">
                            <img class="w-100 border-radius-lg shadow-lg mt-3" src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/product-page.jpg" alt="product_image">
                        </div>
                        <div class="col-12 mt-5">
                            <div class="d-flex">
                                <button class="btn btn-primary btn-sm mb-0 me-2" type="button" name="button">Edit</button>
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
                        <div class="col-12 col-sm-6">
                            <label>Name</label>
                            <input class="form-control" type="text" value="Minimal Bar Stool" onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>
                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                            <label>Weight</label>
                            <input class="form-control" type="number" value="2" onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <label class="mt-4">Collection</label>
                            <input class="form-control" type="text" value="Summer" onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>
                        <div class="col-3">
                            <label class="mt-4">Price</label>
                            <input class="form-control" type="text" value="$90" onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>
                        <div class="col-3">
                            <label class="mt-4">Quantity</label>
                            <input class="form-control" type="number" value="50" onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="mt-4">Description</label>
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
                    <h5 class="font-weight-bolder">Socials</h5>
                    <label>Shoppify Handle</label>
                    <input class="form-control" type="text" value="@argon" onfocus="focused(this)" onfocusout="defocused(this)">
                    <label class="mt-4">Facebook Account</label>
                    <input class="form-control" type="text" value="https://" onfocus="focused(this)" onfocusout="defocused(this)">
                    <label class="mt-4">Instagram Account</label>
                    <input class="form-control" type="text" value="https://" onfocus="focused(this)" onfocusout="defocused(this)">
                </div>
            </div>
        </div>
        <div class="col-sm-8 mt-sm-0 mt-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <h5 class="font-weight-bolder">Pricing</h5>
                        <div class="col-3">
                            <label>Price</label>
                            <input class="form-control" type="number" value="99.00" onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>
                        <div class="col-4">
                            <label>Currency</label>
                            <div class="choices" data-type="select-one" tabindex="0" role="listbox" aria-haspopup="true" aria-expanded="false">
                                <div class="choices__inner"><select class="form-control choices__input" name="choices-sizes" id="choices-currency-edit" hidden="" tabindex="-1" data-choice="active">
                                        <option value="Choice 1">USD</option>
                                    </select>
                                    <div class="choices__list choices__list--single">
                                        <div class="choices__item choices__item--selectable" data-item="" data-id="1" data-value="Choice 1" data-custom-properties="null" aria-selected="true">USD</div>
                                    </div>
                                </div>
                                <div class="choices__list choices__list--dropdown" aria-expanded="false">
                                    <div class="choices__list" role="listbox">
                                        <div id="choices--choices-currency-edit-item-choice-1" class="choices__item choices__item--choice choices__item--selectable is-highlighted" role="option" data-choice="" data-id="1" data-value="Choice 6" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">BTC</div>
                                        <div id="choices--choices-currency-edit-item-choice-2" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="2" data-value="Choice 4" data-select-text="Press to select" data-choice-selectable="">CNY</div>
                                        <div id="choices--choices-currency-edit-item-choice-3" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="3" data-value="Choice 2" data-select-text="Press to select" data-choice-selectable="">EUR</div>
                                        <div id="choices--choices-currency-edit-item-choice-4" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="4" data-value="Choice 3" data-select-text="Press to select" data-choice-selectable="">GBP</div>
                                        <div id="choices--choices-currency-edit-item-choice-5" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="5" data-value="Choice 5" data-select-text="Press to select" data-choice-selectable="">INR</div>
                                        <div id="choices--choices-currency-edit-item-choice-6" class="choices__item choices__item--choice is-selected choices__item--selectable" role="option" data-choice="" data-id="6" data-value="Choice 1" data-select-text="Press to select" data-choice-selectable="">USD</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <label>SKU</label>
                            <input class="form-control" type="text" value="71283476591" onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label class="mt-4">Tags</label>
                            <div class="choices" data-type="select-multiple" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false">
                                <div class="choices__inner"><select class="form-control choices__input" name="choices-tags" id="choices-tags-edit" multiple="" hidden="" tabindex="-1" data-choice="active">
                                        <option value="Choice 1">In Stock</option>
                                        <option value="Two">Out of Stock</option>
                                    </select>
                                    <div class="choices__list choices__list--multiple">
                                        <div class="choices__item choices__item--selectable" data-item="" data-id="1" data-value="Choice 1" data-custom-properties="null" aria-selected="true" data-deletable="">In Stock<button type="button" class="choices__button" aria-label="Remove item: 'Choice 1'" data-button="">Remove item</button></div>
                                        <div class="choices__item choices__item--selectable" data-item="" data-id="2" data-value="Two" data-custom-properties="null" aria-selected="true" data-deletable="">Out of Stock<button type="button" class="choices__button" aria-label="Remove item: 'Two'" data-button="">Remove item</button></div>
                                    </div><input type="text" class="choices__input choices__input--cloned" autocomplete="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" aria-label="false">
                                </div>
                                <div class="choices__list choices__list--dropdown" aria-expanded="false">
                                    <div class="choices__list" aria-multiselectable="true" role="listbox">
                                        <div id="choices--choices-tags-edit-item-choice-1" class="choices__item choices__item--choice choices__item--selectable is-highlighted" role="option" data-choice="" data-id="1" data-value="Choice 4" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">Black Friday</div>
                                        <div id="choices--choices-tags-edit-item-choice-5" class="choices__item choices__item--choice choices__item--disabled" role="option" data-choice="" data-id="5" data-value="One" data-select-text="Press to select" data-choice-disabled="" aria-disabled="true">Expired</div>
                                        <div id="choices--choices-tags-edit-item-choice-3" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="3" data-value="Choice 2" data-select-text="Press to select" data-choice-selectable="">Out of Stock</div>
                                        <div id="choices--choices-tags-edit-item-choice-4" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="4" data-value="Choice 3" data-select-text="Press to select" data-choice-selectable="">Sale</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
@endsection