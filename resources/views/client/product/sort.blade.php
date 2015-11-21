<div class="as-search-sort-wrapper as-search-small-hide" id="as-sort-wrap">
    <div class="as-search-sortbutton-wrapper">
        <button id="as-sort-button" class="as-search-sort-button" aria-haspopup="true" aria-owns="as-sort-drawer" aria-expanded="false" aria-controls="as-sort-drawer" data-toggle="dropdown">
            <span class="as-search-sortbylabel-large">Sắp xếp:</span>
            <span id="as-sort-selected" class="as-search-sort-selected">Mới nhất</span>
                <i class="fa fa-angle-down" id="angle-change"></i>
            </span>
        </button>
    </div>
    <div id="as-sort-drawer" class="as-search-sort-drawer as-tooltip-top-right">
        <div class="as-search-sortoptions">
            <ul class="as-search-sort-list" role="listbox">
                <li role="presentation" id="listbox_newest" class="as-search-sort-listitems">
                    <a href="{{Request::url()}}?page=1&s=newest" role="option" tabindex="-1" aria-selected="true" aria-hidden="true" class="as-search-sort-links as-search-selected-option">
                        <div class="title-body">
                            <span>Mới nhất</span>
                        </div>
                    </a>
                </li>
                <li role="presentation" id="listbox_priceLH" class="as-search-sort-listitems">
                    <a href="{{Request::url()}}?page=1&s=lh" role="option" tabindex="-1" aria-selected="false" class="as-search-sort-links">
                        <div class="title-body">
                            <span>Giá: Thấp đến Cao</span>
                        </div>
                    </a>
                </li>
                <li role="presentation" id="listbox_priceHL" class="as-search-sort-listitems">
                    <a href="{{Request::url()}}?page=1&s=hl" role="option" tabindex="-1" aria-selected="false" class="as-search-sort-links">
                        <div class="title-body">
                            <span>Giá: Cao đến Thấp</span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
