@extends('layouts.app')



@section('title','Dashboard')



@section('page-header')
<h1>
    Dashboard
    <small>v.{{ \Config::get('Silent.version')  }}</small>
</h1>
@endsection



@section('page-content')

  <div class="row">


      <div class="col-md-3">
          <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="fa fa-calendar"></i></span>
              <div class="info-box-content">
                  <span class="info-box-text">Ultima Giornata</span>
                  <span class="info-box-number size30">{{ $lastGiornata->giornata or ''}}</span>
              </div><!-- /.info-box-content -->
          </div>
      </div>


      <div class="col-md-3">
          <div class="info-box">
              <span class="info-box-icon bg-light-blue"><i class="fa fa-group"></i></span>
              <div class="info-box-content">
                  <span class="info-box-text">Squadre</span>
                  <span class="info-box-number size30">{{ $team_count }}</span>
              </div><!-- /.info-box-content -->
          </div>
      </div>



      <div class="col-md-3">
          <div class="info-box">
              <span class="info-box-icon bg-teal"><i class="fa fa-male"></i></span>
              <div class="info-box-content">
                  <span class="info-box-text">Calciatori</span>
                  <span class="info-box-number size30">{{ $player_count }}</span>
              </div><!-- /.info-box-content -->
          </div>
      </div>



      <div class="col-md-3">  </div>



  </div>

    <p>Contenuto</p>

        @if(Auth::check())
            Log Level: {{ Auth::user()->levels_level }}

        @else
            no log
            <br/>
        @endif

    @unless (Auth::check())
        You are not signed in.
    @endunless


    <div class="row">

      <div class="col-md-6">


        <!-- Calendario NEXT -->
            <div class="box">
              <div class="box-header with-border">
                  <i class="fa fa-flag-o fa-fw"></i>
                <h3 class="box-title">Prossima Giornata</h3>
                <div class="box-tools pull-right">
                  <!-- Buttons, labels, and many other things can be placed here! -->
                  <!-- Here is a label for example -->
                  <span class="label label-primary">#{{ $nextGiornata->giornata or '-'}}</span>
                </div><!-- /.box-tools -->
              </div><!-- /.box-header -->
              <div class="box-body">

                  <h4>Giornata {{ $nextGiornata->giornata or '-'}}</h4>

                  <table class="table table-bordered table-striped">

                      <tr>
                          <th style="width:30px;">#</th>
                          <th>Incontro</th>
                          <th>Risultato</th>
                          <th>Punteggio</th>
                          <th style="width: 30px"></th>
                      </tr>

                      <?php $i = 1; ?>
                      @forelse($nextMatches as $match)
                          <tr>
                              <td>{{ $i }}.</td>
                              <td>{{ $match->team1 }} - {{ $match->team2 }}</td>
                              <td>-</td>
                              <td>-</td>
                              <td><a href="#">dettagli</a></td>
                          </tr>
                          <?php $i++; ?>
                      @empty
                          <tr>
                              <td colspan="4">Nessun match programmato.</td>
                          </tr>
                      @endforelse

                  </table>


              </div><!-- /.box-body -->
              <div class="box-footer">
                <a href="{{ url('user') }}">
                    <i class="fa fa-angle-right fa-fw"></i> Vai a Formazione</a>
              </div><!-- box-footer -->
            </div><!-- /.box -->



        <!-- Calendario LAST -->
          <div class="box">
            <div class="box-header with-border">
                <i class="fa fa-flag-checkered fa-fw"></i>
              <h3 class="box-title">Risultati Ultima Giornata</h3>
              <div class="box-tools pull-right">
                <!-- Buttons, labels, and many other things can be placed here! -->
                <!-- Here is a label for example -->
                <span class="label label-primary">#{{ $lastGiornata->giornata or ''}}</span>
              </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">


                <h4>Giornata {{ $lastGiornata->giornata or '-'}}</h4>

                <table class="table table-bordered table-striped">

                    <tr>
                        <th style="width:30px;">#</th>
                        <th>Incontro</th>
                        <th>Risultato</th>
                        <th>Punteggio</th>
                        <th style="width: 30px"></th>
                    </tr>

                    <?php $i = 1; ?>
                    @forelse($lastMatches as $match)
                        <tr>
                            <td>{{ $i }}.</td>
                            <td>{{ $match->team1 }} - {{ $match->team2 }}</td>
                            <td>{{ $match->goalTeam1 }} - {{ $match->goalTeam2 }}</td>
                            <td>{{ $match->resultTeam1 }} - {{ $match->resultTeam2 }}</td>
                            <td><a href="#">dettagli</a></td>
                        </tr>
                        <?php $i++; ?>
                    @empty
                        <tr>
                            <td colspan="4">Nessun match giocato.</td>
                        </tr>
                    @endforelse

                </table>


            </div><!-- /.box-body -->
              <!-- <div class="box-footer">
                The footer of the box
              </div>box-footer -->
          </div><!-- /.box -->
      </div>



      <div class="col-md-6">
        <!-- Classifica -->
          <div class="box">
            <div class="box-header">
              <i class="fa fa-list fa-fw"></i>
              <h3 class="box-title">Classifica</h3>
              <div class="box-tools pull-right">
                <!-- Buttons, labels, and many other things can be placed here! -->
                <!-- Here is a label for example -->
                <span class="label label-primary"></span>
              </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body no-padding">


                <div class="table-responsive ">
                    <table class="table table-striped table-bordered no-margin">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Team</th>
                            <th><span data-toggle="tooltip" data-original-title="Punti">Pt</span></th>
                            <th><span data-toggle="tooltip" data-original-title="Vinte">V</span></th>
                            <th><span data-toggle="tooltip" data-original-title="Nulle">N</span></th>
                            <th><span data-toggle="tooltip" data-original-title="Pareggiate">P</span></th>
                            <th><span data-toggle="tooltip" data-original-title="Gol Fatti">Gf</span></th>
                            <th><span data-toggle="tooltip" data-original-title="Gol Subiti">Gs</span></th>
                            <th><span data-toggle="tooltip" data-original-title="Differenza Reti">Dr</span></th>
                            <th><span data-toggle="tooltip" data-original-title="FantaPunti">Fp</span></th>
                        </tr>
                        <?php $i=1; ?>
                        @foreach($classifica as $c)
                            <tr>
                                <td>{{ $i }}.</td>
                                <td>{{ $c->teams->name or ' - '}}</td>
                                <td>{{ $c->punti }}</td>
                                <td>{{ $c->vinte }}</td>
                                <td>{{ $c->nulle }}</td>
                                <td>{{ $c->perse }}</td>
                                <td>{{ $c->gf }}</td>
                                <td>{{ $c->gs }}</td>
                                <td>{{ $c->differenzaReti }}</td>
                                <td>{{ $c->fp }}</td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                    </table>
                </div>


            </div><!-- /.box-body -->
            <div class="box-footer">
                <i>Aggiornamento giornata #{{ $lastGiornata->giornata or '-'}}</i>
            </div><!-- box-footer -->
          </div><!-- /.box -->
      </div>
    </div>











@endsection