<div class="form-group">
    <label for="bus_id">Xe số</label>
    <select class="form-control col-6" name="bus_id" required>
        @forelse ($buses as $bus)
        <option value="{{$bus->id}}">{{$bus->number}}</option>
        @empty
        <option disabled>Không có xe phù hợp</option>
        @endforelse
    </select>
</div>
<div class="form-group">
    <label for="driver_id">Lái xe</label>
    <select class="form-control col-6" name="driver_id" required>
        @forelse ($drivers as $driver)
        <option value="{{$driver->id}}">{{$driver->name}}</option>
        @empty
        <option disabled>Không có nhân viên phù hợp</option>
        @endforelse
    </select>
</div>
<div class="form-group">
    <label for="ticket_collector_id">Soát vé</label>
    <select class="form-control col-6" name="ticket_collector_id" required>
        @forelse ($ticket_collectors as $ticket_collector)
        <option value="{{$ticket_collector->id}}">{{$ticket_collector->name}}</option>
        @empty
        <option disabled>Không có nhân viên phù hợp</option>
        @endforelse
    </select>
</div>