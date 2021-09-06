{{-- Category Foods --}}
<div class="brands_products">
  <h2>{{ __('custom.food') }}</h2>
  <div class="brands-name">
    <ul class="nav nav-pills nav-stacked">
      @forelse(getCategoriesByType(\App\Enums\CategoryTypes::FOOD) as $row)
        <li>
          <a href="{{ route('search_categories', ['slug' => $row->slug]) }}">
            <span class="pull-right">{{ $row->products()->conditionProduct()->count() }}</span>
            {{ $row->name }}
          </a>
        </li>
      @empty
        {{ __('custom.no_data') }}
      @endforelse
    </ul>
  </div>
</div>
{{-- Category Drinks --}}
<div class="brands_products">
  <h2>{{ __('custom.drink') }}</h2>
  <div class="brands-name">
    <ul class="nav nav-pills nav-stacked">
      @forelse(getCategoriesByType(\App\Enums\CategoryTypes::DRINK) as $row)
        <li>
          <a href="{{ route('search_categories', ['slug' => $row->slug]) }}">
            <span class="pull-right">{{ $row->products()->conditionProduct()->count() }}</span>
            {{ $row->name }}
          </a>
        </li>
      @empty
        {{ __('custom.no_data') }}
      @endforelse
    </ul>
  </div>
</div>
{{-- Image ads --}}
<div class="shipping text-center">
  <img src="/storage/home/poster_drink.jpg" alt="poster-drink" />
</div>
<div class="shipping text-center">
  <img src="/storage/home/banner-shop-page.png" alt="banner-shop-page" />
</div>
{{-- Hash tags --}}
{!! displayTagsSidebar() !!}
