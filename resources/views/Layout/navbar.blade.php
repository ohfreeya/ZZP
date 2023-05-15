@extends('Layout.main')
@section('navbar')
<div class="d-flex flex-column side-bar flex-shrink-0" style="width: 3.5rem;background-color: antiquewhite;">
    <a href="/home" class="d-block p-3 mb-2 link-dark text-center text-decoration-none" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
        <i class="fa-solid fa-otter fa-beat-fade fa-xl" style="color: #db531fc4;"></i>
    </a> 
    <div class="p-2 border-top">
        <a href="#">
            <img src="/image/icon/people.png" alt="" class="rounded-circle w-100 user-image">
        </a>
    </div>
    <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
      <li class="nav-item">
        <a href="#" class="nav-link py-3" aria-current="page" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Home">
            <i class="fa-solid fa-house fa-lg" style="color: #ffbf66;"></i>
        </a>
      </li>
      <li>
        <a href="#" class="nav-link py-3" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Dashboard">
            <i class="fa-solid fa-book fa-lg" style="color: #ffbf66;"></i>
        </a>
      </li>
    </ul>
  </div>
@endsection

@section('js')
    {{-- use bootstrap switch page in navbar by jquery --}}
    <script>
        $(document).ready(function () {
            $('.nav-pills a').click(function (e) {
                e.preventDefault();
                $(this).tab('show');
            });
        });
    </script>
@endsection