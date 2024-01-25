<!DOCTYPE html>
<html lang="en">
  @include('web.common.meta')
   <body>
      @include('web.common.header')


      @yield('content')
      

      @include('web.common.footer')
      
      @include('web.common.scripts')

   </body>
</html>