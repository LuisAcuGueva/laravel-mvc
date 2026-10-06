<div class="field">
    <label for="name">Nombre</label>
    <input id="name" name="name" type="text" value="{{ old('name', $client->name ?? '') }}" required>
    @error('name')<div class="error">{{ $message }}</div>@enderror
</div>

<div class="field">
    <label for="email">Email</label>
    <input id="email" name="email" type="email" value="{{ old('email', $client->email ?? '') }}" required>
    @error('email')<div class="error">{{ $message }}</div>@enderror
</div>

<div class="field">
    <label for="phone">Teléfono</label>
    <input id="phone" name="phone" type="text" value="{{ old('phone', $client->phone ?? '') }}">
    @error('phone')<div class="error">{{ $message }}</div>@enderror
</div>

<div class="field">
    <label for="address">Dirección</label>
    <input id="address" name="address" type="text" value="{{ old('address', $client->address ?? '') }}">
    @error('address')<div class="error">{{ $message }}</div>@enderror
</div>
