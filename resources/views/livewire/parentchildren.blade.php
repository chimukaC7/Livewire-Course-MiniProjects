<div class="card-body">
    {{--  ordinary submit to controller  --}}
    <form action="{{ route('parentchildren.submit') }}" method="POST">
        @csrf

        {{-- Not a livewire --}}
        <div class="form-group {{ $errors->has('customer_name') ? 'has-error' : '' }}">
            Customer name
            <input type="text" name="customer_name" class="form-control"
                   value="{{ old('customer_name') }}" required>
            @if($errors->has('customer_name'))
                <em class="invalid-feedback">
                    {{ $errors->first('customer_name') }}
                </em>
            @endif
        </div>

        {{-- Not a livewire --}}
        <div class="form-group {{ $errors->has('customer_email') ? 'has-error' : '' }}">
            Customer email
            <input type="email" name="customer_email" class="form-control"
                   value="{{ old('customer_email') }}">
            @if($errors->has('customer_email'))
                <em class="invalid-feedback">
                    {{ $errors->first('customer_email') }}
                </em>
            @endif
        </div>

        <div class="card">
            <div class="card-header">
                Products
            </div>

            <div class="card-body">
                <table class="table" id="products_table">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($orderProducts as $index => $orderProduct)
                        <tr>
                            <td>
                                <select name="orderProducts[{{$index}}][product_id]"
                                        wire:model="orderProducts.{{$index}}.product_id"
                                        class="form-control"
                                >
                                    <option value="">-- choose product --</option>
                                    @foreach ($allProducts as $product)
                                        <option value="{{ $product->id }}">
                                            {{ $product->name }} (${{ number_format($product->price, 2) }})
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number"
                                       class="form-control"
                                       name="orderProducts[{{$index}}][quantity]"
                                       wire:model="orderProducts.{{$index}}.quantity"
                                />
                            </td>
                            <td>
                                <a href="#" wire:click.prevent="removeProduct({{$index}})">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-sm btn-secondary"
                                wire:click.prevent="addProduct">+ Add Another Product</button>
                    </div>
                </div>
            </div>
        </div>
        <br />
        <div>
            <input class="btn btn-primary" type="submit" value="Save Order">
        </div>
    </form>
</div>
