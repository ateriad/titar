<div id="search-bar" class="clearfix search-bar-light">
    <form action="{{ route('search.show') }}">
        <div class="search-input float-right">
            <input type="search" name="q" value="{{ $query ?? '' }}" placeholder="جستجو...">
        </div>
        <div class="search-btn float-left text-left">
            <button class="button" name="search" type="submit">یافتن</button>
        </div>
    </form>
</div>
