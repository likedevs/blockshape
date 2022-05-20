@extends('front.app')

@section('content')

@include('front.partials.account-tabs')

  <div class="account-supl">
       <div class="container">
           <div class="row">
               <div class="col-md-12">
                   <div class="account-inside">
                       <p>
                           Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                           tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                           quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                           consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                           cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                           proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                           Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                           tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                           quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                           consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                           cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                           proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                       </p>
                       <h3 class="red">Lista Motivationala</h3>
                       <ul>
                           @if (!empty($items))
                               @foreach ($items as $key => $item)
                                   <li>{{ $item->text }}</li>
                               @endforeach
                           @endif
                       </ul>
                       <form  action="{{ route('motivation.add') }}" method="post">
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input class="add-new hidden" type="text" name="item[]" value="">
                           <div id="mark-space"></div>
                           <div class="add-item">
                               <span class="add-input">
                                   mai adauga <i></i> motive
                               </span>
                           </div>
                           <div class="comments">
                                <label for="comment">Comentarii si notite</label>
                                <textarea id="comment" name="comment">{{ !is_null($diary) ? $diary->comment : '' }}</textarea>
                                <input type="submit" value="Transmite datele">
                           </div>

                       </form>
                   </div>
               </div>
           </div>
       </div>
  </div>

@include('front.partials.prefooter')

@include('front.partials.footer-line')

@stop
