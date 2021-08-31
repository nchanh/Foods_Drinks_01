<?php
    use App\Enums\Status;

    if (!function_exists('checkLanguage')) {
        function checkLanguage($result1, $result2)
        {
            if (session('website_language') == 'en')
            {
                return $result1;
            }
            return $result2;
        }
    }

  if (!function_exists('checkLanguageWithDay')) {
      function checkLanguageWithDay($date)
      {
          if (session('website_language') == 'en')
          {
            return date_format($date, 'M d, Y h:i A');
          }
        return date_format($date, ' H:i d/m/Y');
      }
  }

  if (!function_exists('checkStatus')) {
      function checkStatus($status)
      {
          if ($status === Status::ACTIVE)
          {
              return __('custom.status_active');
          }
          else if ($status === Status::CANCEL) {
              return __('custom.order_cancel');
          }
          return __('custom.status_block');
      }
  }
