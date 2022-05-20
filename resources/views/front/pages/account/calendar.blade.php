@extends('front.app')

@section('content')

@include('front.partials.account-tabs')

<div class="account-supl">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="account-inside calendar">

                    <h1>Calendar</h1>
                    <div class="container">
                        <div class="row">
                            <form  action="" method="get">
                                <div class="col-md-5 text-right">
                                    <label for="">Selectati luna</label>
                                    <select class="select-full" name="month">
                                        @if (!empty(getMonthList(Auth::user()->id)['months']))
                                            @foreach (getMonthList(Auth::user()->id)['months'] as $key => $value)
                                                <option value="{{ $value }}" {{ $value == $month ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Selectati anul</label>
                                    <select class="select-full" name="year">
                                        @if (!empty(getMonthList(Auth::user()->id)['years']))
                                            @foreach (getMonthList(Auth::user()->id)['years'] as $key => $value)
                                                <option value="{{ $value }}" {{ $value == $year ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <input type="submit" class="send-form btn btn-default" value="Alege">
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                        setlocale(LC_TIME,"ro_RO");
                        $rationTerm = App\MRationTerm::where('user_id', Auth::user()->id)->first();

                        $day = date('d', $date);
                        $month = date('m', $date);
                        $year = date('Y', $date);
                        $firstDay = mktime(0,0,0,$month, 1, $year);
                        $title = strftime('%B', $firstDay);

                        $daysInMonth = cal_days_in_month(0, $month, $year);
                    ?>

                    <div class="calendar-full">
                         @for($i = 1; $i <= $daysInMonth; $i++)
                             <?php $now = $year."-".$month."-".str_pad($i, 2, 0, STR_PAD_LEFT) ?>
                            @if($day == $i)
                                <div class="item today {{ Helper::getMenstruationPeriod($now) == 'catabolic' ? 'green' : '' }} {{ Helper::emptyDay($now) == true ? 'empty': '' }}">
                                    <a href="{{ route('history.date', ['date' => $now]) }}">
                                        <strong>
                                            <?php echo $i.' '.$title ?>
                                        </strong>
                                    </a>
                                </div>
                            @else
                                @if (!is_null($rationTerm))

                                    @if((strtotime($rationTerm->term_to)  < strtotime($now))  ||  strtotime($rationTerm->term_from)  > strtotime($now))
                                        <div class="item pasive">
                                            <a>
                                                <?php echo $i.' '.$title ?>
                                            </a>
                                        </div>
                                    @else
                                        <div class="item  {{Helper::getMenstruationPeriod($now)=='catabolic'?'green':''}} {{ Helper::emptyDay($now) == true ? 'empty': ''}}"
                                        >
                                            <a href="{{ route('history.date', ['date' => $now]) }}">
                                                {{ $i.' '.$title }}
                                                <small class="weight">{{ Helper::getWeight($now) }} </small>
                                            </a>
                                        </div>
                                    @endif

                                @endif
                            @endif
                        @endfor
                    </div>

                    @if (!is_null($diary))
                        @if ($diary->menstruation_start > 0)
                        <div class="row periods">
                            <div class="col-md-4 item">
                                <i class="blue">.</i>
                                <span>Perioada Anabolica</span>
                            </div>
                            <div class="col-md-4 item">
                                <i class="green">.</i>
                                <span>Perioada Catabolica</span>
                            </div>
                            <div class="col-md-4 item">
                                <i class="red-border">.</i>
                                <span>Zile Necompletate</span>
                            </div>
                        </div>
                        @endif
                    @endif

                    @if (Session::get('history_date') <= date('Y-m-d'))

                    <div class="descr">
                        <p>Pentru a putea analiza și monitoriza calea obținerii rezultatului dorit de tine este necesar să completezi Agenda Zilnică. Ea va fi analizată la solicitarea ta prin Consultație Personală. Așa va fi posibilă detectarea tuturor erorilor și ghidarea spre rezultatul dorit. Pentru detectarea erorilor este necesară completarea zilnică sinceră și deplină minim 1lună.</p>
                    </div>

                    <div class="diary">
                        <h2>Agenda Zilnica</h2>
                        @if (!is_null($diary))
                            @if ($diary->empty == 0)
                            <form action="{{ route('diary.set') }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="row form">
                                @if ($diary->menstruation_start > 0)
                                <div class="col-md-3">
                                    <label>Ziua start menstruatie in luna curenta</label>
                                    <select name="menstruation_start">
                                        <option value="0" {{ $diary->menstruation_start == 0 ? 'selected' : '' }}>Introduceti ziua</option>
                                        <option value="1" {{ $diary->menstruation_start == 1 ? 'selected' : '' }}>1</option>
                                        <option value="2" {{ $diary->menstruation_start == 2 ? 'selected' : '' }}>2</option>
                                        <option value="3" {{ $diary->menstruation_start == 3 ? 'selected' : '' }}>3</option>
                                        <option value="4" {{ $diary->menstruation_start == 4 ? 'selected' : '' }}>4</option>
                                        <option value="5" {{ $diary->menstruation_start == 5 ? 'selected' : '' }}>5</option>
                                        <option value="6" {{ $diary->menstruation_start == 6 ? 'selected' : '' }}>6</option>
                                        <option value="7" {{ $diary->menstruation_start == 7 ? 'selected' : '' }}>7</option>
                                        <option value="8" {{ $diary->menstruation_start == 8 ? 'selected' : '' }}>8</option>
                                        <option value="9" {{ $diary->menstruation_start == 9 ? 'selected' : '' }}>9</option>
                                        <option value="10" {{ $diary->menstruation_start == 10 ? 'selected' : '' }}>10</option>
                                        <option value="11" {{ $diary->menstruation_start == 11 ? 'selected' : '' }}>11</option>
                                        <option value="12" {{ $diary->menstruation_start == 12 ? 'selected' : '' }}>12</option>
                                        <option value="13" {{ $diary->menstruation_start == 13 ? 'selected' : '' }}>13</option>
                                        <option value="14" {{ $diary->menstruation_start == 14 ? 'selected' : '' }}>14</option>
                                        <option value="15" {{ $diary->menstruation_start == 14 ? 'selected' : '' }}>15</option>
                                        <option value="16" {{ $diary->menstruation_start == 15 ? 'selected' : '' }}>16</option>
                                        <option value="17" {{ $diary->menstruation_start == 17 ? 'selected' : '' }}>17</option>
                                        <option value="18" {{ $diary->menstruation_start == 18 ? 'selected' : '' }}>18</option>
                                        <option value="19" {{ $diary->menstruation_start == 19 ? 'selected' : '' }}>19</option>
                                        <option value="20" {{ $diary->menstruation_start == 20 ? 'selected' : '' }}>20</option>
                                        <option value="21" {{ $diary->menstruation_start == 21 ? 'selected' : '' }}>21</option>
                                        <option value="22" {{ $diary->menstruation_start == 22 ? 'selected' : '' }}>22</option>
                                        <option value="23" {{ $diary->menstruation_start == 23 ? 'selected' : '' }}>23</option>
                                        <option value="24" {{ $diary->menstruation_start == 24 ? 'selected' : '' }}>24</option>
                                        <option value="25" {{ $diary->menstruation_start == 25 ? 'selected' : '' }}>25</option>
                                        <option value="26" {{ $diary->menstruation_start == 26 ? 'selected' : '' }}>26</option>
                                        <option value="27" {{ $diary->menstruation_start == 27 ? 'selected' : '' }}>27</option>
                                        <option value="28" {{ $diary->menstruation_start == 28 ? 'selected' : '' }}>28</option>
                                        <option value="29" {{ $diary->menstruation_start == 29 ? 'selected' : '' }}>29</option>
                                        <option value="30" {{ $diary->menstruation_start == 30 ? 'selected' : '' }}>30</option>
                                    </select>
                                @endif
                                </div>

                                <div class="col-md-2">
                                    <label>Ora trezirii</label>
                                    <select name="wake">
                                        <option value="0">Alegeti ora</option>
                                        <option value="06.00" {{ $diary->wake == '06.00' ? 'selected' : ''}}>06.00</option>
                                        <option value="06.30" {{ $diary->wake == '06.30' ? 'selected' : ''}}>06.30</option>
                                        <option value="07.00" {{ $diary->wake == '07.00' ? 'selected' : ''}}>07.00</option>
                                        <option value="07.30" {{ $diary->wake == '07.30' ? 'selected' : ''}}>07.30</option>
                                        <option value="08.00" {{ $diary->wake == '08.00' ? 'selected' : ''}}>08.00</option>
                                        <option value="08.30" {{ $diary->wake == '08.30' ? 'selected' : ''}}>08.30</option>
                                        <option value="09.00" {{ $diary->wake == '09.00' ? 'selected' : ''}}>09.00</option>
                                        <option value="09.30" {{ $diary->wake == '09.30' ? 'selected' : ''}}>09.30</option>
                                        <option value="10.00" {{ $diary->wake == '10.00' ? 'selected' : ''}}>10.00</option>
                                        <option value="10.30" {{ $diary->wake == '10.30' ? 'selected' : ''}}>10.30</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>Apa consumatĂ</label>
                                    <select name="water">
                                        <option value="0.5" {{ $diary->water == '0.5' ? 'selected' : ''}}>0.5 L</option>
                                        <option value="1"  {{ $diary->water == '1' ? 'selected' : ''}}>1 L</option>
                                        <option value="1.5"  {{ $diary->water == '1.5' ? 'selected' : ''}}>1.5 L</option>
                                        <option value="2"  {{ $diary->water == '2' ? 'selected' : ''}}>2 L</option>
                                        <option value="2.5"  {{ $diary->water == '2.5' ? 'selected' : ''}}>2.5 L</option>
                                        <option value="3"  {{ $diary->water == '3' ? 'selected' : ''}}>3 L</option>
                                        <option value="3.5"  {{ $diary->water == '3.5' ? 'selected' : ''}}>3.5 L</option>
                                        <option value="4"  {{ $diary->water == '4' ? 'selected' : ''}}>4 L</option>
                                        <option value="4.5"  {{ $diary->water == '4.5' ? 'selected' : ''}}>4.5 L</option>
                                        <option value="5"  {{ $diary->water == '5' ? 'selected' : ''}}>5 L</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>Masa corpului</label>
                                    <input type="text" name="weight" placeholder="Introduceti KG" value="{{ $diary->weight_body }}" id="body-weight">
                                </div>
                                <div class="col-md-3">
                                    <label>DiferenȚa de la ultima masurare</label>
                                    <input type="text" name="diff_last" placeholder="" value="{{ $diary->diff_last }}" id="begin" data="{{ $beginWeight }}">
                                    <label>DiferenȚa de la inceputul abonamentului</label>
                                    <input type="text" name="diff_begin" placeholder="" value="{{ $diary->diff_begin }}" id="last" data="{{ $lastWeight }}">
                                </div>
                            </div>
                            <div class="row form">
                                <div class="col-md-3">
                                    <label>Proces fiziologic</label>
                                    <input type="text" name="dejection_qty" placeholder="Alegeti cite ori pentru ziua curenta" value="{{ $diary->dejection_qty }}">
                                    <select name="dejection_solidity">
                                        <option value="solida" {{  $diary->dejection_solidity == 'solida' ? 'selected' : '' }}>Solida</option>
                                        <option value="medie" {{  $diary->dejection_solidity == 'medie' ? 'selected' : '' }}>Medie</option>
                                        <option value="lichida" {{  $diary->dejection_solidity == 'lichida' ? 'selected' : '' }}>Lichida</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Produsele consumate</label>
                                    <div>
                                        @include('front.partials.calendar.foodSelect')
                                    </div>
                                    <div class="to-clone hidden">
                                        <select name="food_hour[]">
                                            <option value="06.00">06.00</option>
                                            <option value="06.30">06.30</option>
                                            <option value="07.00">07.00</option>
                                            <option value="07.30">07.30</option>
                                            <option value="08.00">08.00</option>
                                            <option value="08.30">08.30</option>
                                            <option value="09.00">09.00</option>
                                            <option value="09.30">09.30</option>
                                            <option value="10.00">10.00</option>
                                            <option value="10.30">10.30</option>
                                            <option value="11.00">11.00</option>
                                            <option value="11.30">11.30</option>
                                            <option value="12.00">12.00</option>
                                            <option value="12.30">12.30</option>
                                            <option value="13.00">13.00</option>
                                            <option value="14.00">14.00</option>
                                            <option value="14.30">14.30</option>
                                            <option value="15.00">15.00</option>
                                            <option value="15.30">15.30</option>
                                            <option value="16.00">16.00</option>
                                            <option value="16.30">16.30</option>
                                            <option value="17.00">17.00</option>
                                            <option value="17.30">17.30</option>
                                            <option value="18.00">18.00</option>
                                            <option value="18.30">18.30</option>
                                            <option value="19.00">19.00</option>
                                            <option value="19.30">19.30</option>
                                            <option value="20.00">20.00</option>
                                            <option value="20.30">20.30</option>
                                            <option value="21.00">21.00</option>
                                            <option value="21.30">21.30</option>
                                            <option value="22.00">22.00</option>
                                            <option value="22.30">22.30</option>
                                            <option value="23.00">23.00</option>
                                            <option value="23.30">23.30</option>
                                            <option value="00.00">00.00</option>
                                            <option value="00.30">00.30</option>
                                            <option value="01.00">01.00</option>
                                            <option value="01.30">01.30</option>
                                        </select>
                                        <input type="text" name="food[]" placeholder="Ce ati mincat">
                                        <input type="text" name="food_qty[]" placeholder="Cantitate">
                                        <input type="hidden" name="item[]" value="0">
                                    </div>
                                    <span class="add-form">+</span>
                                </div>
                                <div class="col-md-3">
                                    <label>Antrenamentul</label>
                                    <div>
                                        @include('front.partials.calendar.trainingSelect')
                                    </div>
                                    <div class="to-clone2 hidden">
                                        <select name="training_hour[]">
                                            <option value="06.00">06.00</option>
                                            <option value="06.30">06.30</option>
                                            <option value="07.00">07.00</option>
                                            <option value="07.30">07.30</option>
                                            <option value="08.00">08.00</option>
                                            <option value="08.30">08.30</option>
                                            <option value="09.00">09.00</option>
                                            <option value="09.30">09.30</option>
                                            <option value="10.00">10.00</option>
                                            <option value="10.30">10.30</option>
                                            <option value="11.00">11.00</option>
                                            <option value="11.30">11.30</option>
                                            <option value="12.00">12.00</option>
                                            <option value="12.30">12.30</option>
                                            <option value="13.00">13.00</option>
                                            <option value="14.00">14.00</option>
                                            <option value="14.30">14.30</option>
                                            <option value="15.00">15.00</option>
                                            <option value="15.30">15.30</option>
                                            <option value="16.00">16.00</option>
                                            <option value="16.30">16.30</option>
                                            <option value="17.00">17.00</option>
                                            <option value="17.30">17.30</option>
                                            <option value="18.00">18.00</option>
                                            <option value="18.30">18.30</option>
                                            <option value="19.00">19.00</option>
                                            <option value="19.30">19.30</option>
                                            <option value="20.00">20.00</option>
                                            <option value="20.30">20.30</option>
                                            <option value="21.00">21.00</option>
                                            <option value="21.30">21.30</option>
                                            <option value="22.00">22.00</option>
                                            <option value="22.30">22.30</option>
                                            <option value="23.00">23.00</option>
                                            <option value="23.30">23.30</option>
                                            <option value="00.00">00.00</option>
                                            <option value="00.30">00.30</option>
                                            <option value="01.00">01.00</option>
                                            <option value="01.30">01.30</option>
                                        </select>
                                        <input type="text" name="training_duration[]" placeholder="Durata">
                                        <input type="hidden" name="tren[]" value="0">
                                    </div>
                                    <span class="add-form2">+</span>
                                </div>
                                <div class="col-md-3">
                                    <label>Puls</label>
                                    <input type="text" name="puls" placeholder="Cat iti este pulsul" value="{{ $diary->puls }}">
                                </div>
                            </div>
                        </div>
                        <div class="comments">
                            <label for="comment">Comentarii si notite</label>
                            <textarea id="comment" name="comment">{{ $diary->comment }}</textarea>
                            <input type="submit" name="" value="Transmite datele">
                        </div>
                        </form>
                            @else
                                <form action="{{ route('diary.set') }}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row form">
                                    @if ($diary->menstruation_start > 0)
                                    <div class="col-md-3">
                                        <label>Ziua start menstruatie in luna curenta</label>
                                        <select name="menstruation_start">
                                            <option value="0" {{ $diary->menstruation_start == 0 ? 'selected' : '' }}>Introduceti ziua</option>
                                            <option value="1" {{ $diary->menstruation_start == 1 ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ $diary->menstruation_start == 2 ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ $diary->menstruation_start == 3 ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ $diary->menstruation_start == 4 ? 'selected' : '' }}>4</option>
                                            <option value="5" {{ $diary->menstruation_start == 5 ? 'selected' : '' }}>5</option>
                                            <option value="6" {{ $diary->menstruation_start == 6 ? 'selected' : '' }}>6</option>
                                            <option value="7" {{ $diary->menstruation_start == 7 ? 'selected' : '' }}>7</option>
                                            <option value="8" {{ $diary->menstruation_start == 8 ? 'selected' : '' }}>8</option>
                                            <option value="9" {{ $diary->menstruation_start == 9 ? 'selected' : '' }}>9</option>
                                            <option value="10" {{ $diary->menstruation_start == 10 ? 'selected' : '' }}>10</option>
                                            <option value="11" {{ $diary->menstruation_start == 11 ? 'selected' : '' }}>11</option>
                                            <option value="12" {{ $diary->menstruation_start == 12 ? 'selected' : '' }}>12</option>
                                            <option value="13" {{ $diary->menstruation_start == 13 ? 'selected' : '' }}>13</option>
                                            <option value="14" {{ $diary->menstruation_start == 14 ? 'selected' : '' }}>14</option>
                                            <option value="15" {{ $diary->menstruation_start == 14 ? 'selected' : '' }}>15</option>
                                            <option value="16" {{ $diary->menstruation_start == 15 ? 'selected' : '' }}>16</option>
                                            <option value="17" {{ $diary->menstruation_start == 17 ? 'selected' : '' }}>17</option>
                                            <option value="18" {{ $diary->menstruation_start == 18 ? 'selected' : '' }}>18</option>
                                            <option value="19" {{ $diary->menstruation_start == 19 ? 'selected' : '' }}>19</option>
                                            <option value="20" {{ $diary->menstruation_start == 20 ? 'selected' : '' }}>20</option>
                                            <option value="21" {{ $diary->menstruation_start == 21 ? 'selected' : '' }}>21</option>
                                            <option value="22" {{ $diary->menstruation_start == 22 ? 'selected' : '' }}>22</option>
                                            <option value="23" {{ $diary->menstruation_start == 23 ? 'selected' : '' }}>23</option>
                                            <option value="24" {{ $diary->menstruation_start == 24 ? 'selected' : '' }}>24</option>
                                            <option value="25" {{ $diary->menstruation_start == 25 ? 'selected' : '' }}>25</option>
                                            <option value="26" {{ $diary->menstruation_start == 26 ? 'selected' : '' }}>26</option>
                                            <option value="27" {{ $diary->menstruation_start == 27 ? 'selected' : '' }}>27</option>
                                            <option value="28" {{ $diary->menstruation_start == 28 ? 'selected' : '' }}>28</option>
                                            <option value="29" {{ $diary->menstruation_start == 29 ? 'selected' : '' }}>29</option>
                                            <option value="30" {{ $diary->menstruation_start == 30 ? 'selected' : '' }}>30</option>
                                        </select>
                                    </div>
                                    @endif
                                    <div class="col-md-2">
                                        <label>Ora trezirii</label>
                                        <select name="wake">
                                            <option value="0">Alegeti ora</option>
                                            <option value="06.00">06.00</option>
                                            <option value="06.30">06.30</option>
                                            <option value="07.00">07.00</option>
                                            <option value="07.30">07.30</option>
                                            <option value="08.00">08.00</option>
                                            <option value="08.30">08.30</option>
                                            <option value="09.00">09.00</option>
                                            <option value="09.30">09.30</option>
                                            <option value="10.00">10.00</option>
                                            <option value="10.30">10.30</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Apa consumatĂ</label>
                                        <select name="water">
                                            <option value="0.5">0.5 L</option>
                                            <option value="1">1 L</option>
                                            <option value="1.5">1.5 L</option>
                                            <option value="2">2 L</option>
                                            <option value="2.5">2.5 L</option>
                                            <option value="3">3 L</option>
                                            <option value="3.5">3.5 L</option>
                                            <option value="4">4 L</option>
                                            <option value="4.5">4.5 L</option>
                                            <option value="5">5 L</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Masa corpului</label>
                                        <input type="text" name="weight" placeholder="Introduceti KG" id="body-weight">
                                    </div>
                                    <div class="col-md-3">
                                        <label><small>DiferenȚa de la ultima masurare</small></label>
                                        <input type="text" name="diff_last" placeholder="" id="begin" data="{{ $beginWeight }}">
                                        <label><small>DiferenȚa de la inceputul abonamentului</small></label>
                                        <input type="text" name="diff_begin" placeholder="" id="last" data="{{ $lastWeight }}">
                                    </div>
                                </div>

                                <div class="row form">
                                    <div class="col-md-3">
                                        <label>Proces fiziologic</label>
                                        <input type="text" name="dejection_qty" placeholder="Alegeti cite ori pentru ziua curenta">
                                        <select name="dejection_solidity">
                                            <option value="solida">Solida</option>
                                            <option value="medie">Medie</option>
                                            <option value="lichida">Lichida</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Produsele consumate</label>
                                        <div>
                                            <select name="food_hour[]">
                                                <option value="06.00">06.00</option>
                                                <option value="06.30">06.30</option>
                                                <option value="07.00">07.00</option>
                                                <option value="07.30">07.30</option>
                                                <option value="08.00">08.00</option>
                                                <option value="08.30">08.30</option>
                                                <option value="09.00">09.00</option>
                                                <option value="09.30">09.30</option>
                                                <option value="10.00">10.00</option>
                                                <option value="10.30">10.30</option>
                                                <option value="11.00">11.00</option>
                                                <option value="11.30">11.30</option>
                                                <option value="12.00">12.00</option>
                                                <option value="12.30">12.30</option>
                                                <option value="13.00">13.00</option>
                                                <option value="14.00">14.00</option>
                                                <option value="14.30">14.30</option>
                                                <option value="15.00">15.00</option>
                                                <option value="15.30">15.30</option>
                                                <option value="16.00">16.00</option>
                                                <option value="16.30">16.30</option>
                                                <option value="17.00">17.00</option>
                                                <option value="17.30">17.30</option>
                                                <option value="18.00">18.00</option>
                                                <option value="18.30">18.30</option>
                                                <option value="19.00">19.00</option>
                                                <option value="19.30">19.30</option>
                                                <option value="20.00">20.00</option>
                                                <option value="20.30">20.30</option>
                                                <option value="21.00">21.00</option>
                                                <option value="21.30">21.30</option>
                                                <option value="22.00">22.00</option>
                                                <option value="22.30">22.30</option>
                                                <option value="23.00">23.00</option>
                                                <option value="23.30">23.30</option>
                                                <option value="00.00">00.00</option>
                                                <option value="00.30">00.30</option>
                                                <option value="01.00">01.00</option>
                                                <option value="01.30">01.30</option>
                                            </select>
                                            <input type="text" name="food[]" placeholder="Ce ati mincat">
                                            <input type="text" name="food_qty[]" placeholder="Cantitate">
                                        </div>
                                        <div class="to-clone hidden">
                                            <select name="food_hour[]">
                                                <option value="06.00">06.00</option>
                                                <option value="06.30">06.30</option>
                                                <option value="07.00">07.00</option>
                                                <option value="07.30">07.30</option>
                                                <option value="08.00">08.00</option>
                                                <option value="08.30">08.30</option>
                                                <option value="09.00">09.00</option>
                                                <option value="09.30">09.30</option>
                                                <option value="10.00">10.00</option>
                                                <option value="10.30">10.30</option>
                                                <option value="11.00">11.00</option>
                                                <option value="11.30">11.30</option>
                                                <option value="12.00">12.00</option>
                                                <option value="12.30">12.30</option>
                                                <option value="13.00">13.00</option>
                                                <option value="14.00">14.00</option>
                                                <option value="14.30">14.30</option>
                                                <option value="15.00">15.00</option>
                                                <option value="15.30">15.30</option>
                                                <option value="16.00">16.00</option>
                                                <option value="16.30">16.30</option>
                                                <option value="17.00">17.00</option>
                                                <option value="17.30">17.30</option>
                                                <option value="18.00">18.00</option>
                                                <option value="18.30">18.30</option>
                                                <option value="19.00">19.00</option>
                                                <option value="19.30">19.30</option>
                                                <option value="20.00">20.00</option>
                                                <option value="20.30">20.30</option>
                                                <option value="21.00">21.00</option>
                                                <option value="21.30">21.30</option>
                                                <option value="22.00">22.00</option>
                                                <option value="22.30">22.30</option>
                                                <option value="23.00">23.00</option>
                                                <option value="23.30">23.30</option>
                                                <option value="00.00">00.00</option>
                                                <option value="00.30">00.30</option>
                                                <option value="01.00">01.00</option>
                                                <option value="01.30">01.30</option>
                                            </select>
                                            <input type="text" name="food[]" placeholder="Ce ati mincat">
                                            <input type="text" name="food_qty[]" placeholder="Cantitate">
                                        </div>
                                        <span class="add-form">+</span>

                                    </div>
                                    <div class="col-md-3">
                                        <label>Antrenamentul</label>
                                        <div>
                                            <select name="training_hour[]">
                                                <option value="06.00">06.00</option>
                                                <option value="06.30">06.30</option>
                                                <option value="07.00">07.00</option>
                                                <option value="07.30">07.30</option>
                                                <option value="08.00">08.00</option>
                                                <option value="08.30">08.30</option>
                                                <option value="09.00">09.00</option>
                                                <option value="09.30">09.30</option>
                                                <option value="10.00">10.00</option>
                                                <option value="10.30">10.30</option>
                                                <option value="11.00">11.00</option>
                                                <option value="11.30">11.30</option>
                                                <option value="12.00">12.00</option>
                                                <option value="12.30">12.30</option>
                                                <option value="13.00">13.00</option>
                                                <option value="14.00">14.00</option>
                                                <option value="14.30">14.30</option>
                                                <option value="15.00">15.00</option>
                                                <option value="15.30">15.30</option>
                                                <option value="16.00">16.00</option>
                                                <option value="16.30">16.30</option>
                                                <option value="17.00">17.00</option>
                                                <option value="17.30">17.30</option>
                                                <option value="18.00">18.00</option>
                                                <option value="18.30">18.30</option>
                                                <option value="19.00">19.00</option>
                                                <option value="19.30">19.30</option>
                                                <option value="20.00">20.00</option>
                                                <option value="20.30">20.30</option>
                                                <option value="21.00">21.00</option>
                                                <option value="21.30">21.30</option>
                                                <option value="22.00">22.00</option>
                                                <option value="22.30">22.30</option>
                                                <option value="23.00">23.00</option>
                                                <option value="23.30">23.30</option>
                                                <option value="00.00">00.00</option>
                                                <option value="00.30">00.30</option>
                                                <option value="01.00">01.00</option>
                                                <option value="01.30">01.30</option>
                                            </select>
                                            <input type="text" name="training_duration[]" placeholder="Durata">
                                        </div>
                                        <div class="to-clone2 hidden">
                                            <select name="training_hour[]">
                                                <option value="06.00">06.00</option>
                                                <option value="06.30">06.30</option>
                                                <option value="07.00">07.00</option>
                                                <option value="07.30">07.30</option>
                                                <option value="08.00">08.00</option>
                                                <option value="08.30">08.30</option>
                                                <option value="09.00">09.00</option>
                                                <option value="09.30">09.30</option>
                                                <option value="10.00">10.00</option>
                                                <option value="10.30">10.30</option>
                                                <option value="11.00">11.00</option>
                                                <option value="11.30">11.30</option>
                                                <option value="12.00">12.00</option>
                                                <option value="12.30">12.30</option>
                                                <option value="13.00">13.00</option>
                                                <option value="14.00">14.00</option>
                                                <option value="14.30">14.30</option>
                                                <option value="15.00">15.00</option>
                                                <option value="15.30">15.30</option>
                                                <option value="16.00">16.00</option>
                                                <option value="16.30">16.30</option>
                                                <option value="17.00">17.00</option>
                                                <option value="17.30">17.30</option>
                                                <option value="18.00">18.00</option>
                                                <option value="18.30">18.30</option>
                                                <option value="19.00">19.00</option>
                                                <option value="19.30">19.30</option>
                                                <option value="20.00">20.00</option>
                                                <option value="20.30">20.30</option>
                                                <option value="21.00">21.00</option>
                                                <option value="21.30">21.30</option>
                                                <option value="22.00">22.00</option>
                                                <option value="22.30">22.30</option>
                                                <option value="23.00">23.00</option>
                                                <option value="23.30">23.30</option>
                                                <option value="00.00">00.00</option>
                                                <option value="00.30">00.30</option>
                                                <option value="01.00">01.00</option>
                                                <option value="01.30">01.30</option>
                                            </select>
                                            <input type="text" name="training_duration[]" placeholder="Durata">
                                        </div>

                                        <span class="add-form2">+</span>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Puls</label>
                                        <input type="text" name="puls" placeholder="Cat iti este pulsul">
                                    </div>
                                </div>
                            </div>
                            <div class="comments">
                                <label for="comment">Comentarii si notite</label>
                                <textarea id="comment" name="comment"></textarea>
                                <div class="form-group text-center">
                                    <input type="submit" class="btn btn-default pull-center" value="Salveaza">
                                </div>
                            </div>
                            </form>
                            @endif
                        @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@include('front.partials.prefooter')

@include('front.partials.footer-line')

@stop
