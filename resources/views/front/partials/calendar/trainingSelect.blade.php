@if (count($diary->trainings) > 0)
    @foreach ($diary->trainings as $key => $training)
        <select name="training_hour[]">
            <option value="06.00" {{ $training->time == 06.00 ? 'selected' : ''}}>06.00</option>
            <option value="06.30" {{ $training->time == 06.30 ? 'selected' : ''}}>06.30</option>
            <option value="07.00" {{ $training->time == 07.00 ? 'selected' : ''}}>07.00</option>
            <option value="07.30" {{ $training->time == 07.30 ? 'selected' : ''}}>07.30</option>
            <option value="08.00" {{ $training->time == 08.00 ? 'selected' : ''}}>08.00</option>
            <option value="08.30" {{ $training->time == 08.30 ? 'selected' : ''}}>08.30</option>
            <option value="09.00" {{ $training->time == 09.00 ? 'selected' : ''}}>09.00</option>
            <option value="09.30" {{ $training->time == 09.30 ? 'selected' : ''}}>09.30</option>
            <option value="10.00" {{ $training->time == 10.00 ? 'selected' : ''}}>10.00</option>
            <option value="10.30" {{ $training->time == 10.30 ? 'selected' : ''}}>10.30</option>
            <option value="11.00" {{ $training->time == 11.00 ? 'selected' : ''}}>11.00</option>
            <option value="11.30" {{ $training->time == 11.30 ? 'selected' : ''}}>11.30</option>
            <option value="12.00" {{ $training->time == 12.00 ? 'selected' : ''}}>12.00</option>
            <option value="12.30" {{ $training->time == 12.30 ? 'selected' : ''}}>12.30</option>
            <option value="13.00" {{ $training->time == 13.00 ? 'selected' : ''}}>13.00</option>
            <option value="14.00" {{ $training->time == 14.00 ? 'selected' : ''}}>14.00</option>
            <option value="14.30" {{ $training->time == 14.30 ? 'selected' : ''}}>14.30</option>
            <option value="15.00" {{ $training->time == 15.00 ? 'selected' : ''}}>15.00</option>
            <option value="15.30" {{ $training->time == 15.30 ? 'selected' : ''}}>15.30</option>
            <option value="16.00" {{ $training->time == 16.00 ? 'selected' : ''}}>16.00</option>
            <option value="16.30" {{ $training->time == 16.30 ? 'selected' : ''}}>16.30</option>
            <option value="17.00" {{ $training->time == 17.00 ? 'selected' : ''}}>17.00</option>
            <option value="17.30" {{ $training->time == 17.30 ? 'selected' : ''}}>17.30</option>
            <option value="18.00" {{ $training->time == 18.00 ? 'selected' : ''}}>18.00</option>
            <option value="18.30" {{ $training->time == 18.30 ? 'selected' : ''}}>18.30</option>
            <option value="19.00" {{ $training->time == 19.00 ? 'selected' : ''}}>19.00</option>
            <option value="19.30" {{ $training->time == 19.30 ? 'selected' : ''}}>19.30</option>
            <option value="20.00" {{ $training->time == 20.00 ? 'selected' : ''}}>20.00</option>
            <option value="20.30" {{ $training->time == 20.30 ? 'selected' : ''}}>20.30</option>
            <option value="21.00" {{ $training->time == 21.00 ? 'selected' : ''}}>21.00</option>
            <option value="21.30" {{ $training->time == 21.30 ? 'selected' : ''}}>21.30</option>
            <option value="22.00" {{ $training->time == 22.00 ? 'selected' : ''}}>22.00</option>
            <option value="22.30" {{ $training->time == 22.30 ? 'selected' : ''}}>22.30</option>
            <option value="23.00" {{ $training->time == 23.00 ? 'selected' : ''}}>23.00</option>
            <option value="23.30" {{ $training->time == 23.30 ? 'selected' : ''}}>23.30</option>
            <option value="00.00" {{ $training->time == 00.00 ? 'selected' : ''}}>00.00</option>
            <option value="00.30" {{ $training->time == 00.30 ? 'selected' : ''}}>00.30</option>
            <option value="01.00" {{ $training->time == 01.00 ? 'selected' : ''}}>01.00</option>
            <option value="01.30" {{ $training->time == 01.30 ? 'selected' : ''}}>01.30</option>
        </select>
        <input type="text" name="training_duration[]" placeholder="Durata" value="{{ $training->duration }}">
        <input type="hidden" name="tren[]" value="{{ $training->id }}">
        <br><br>
    @endforeach
@endif
