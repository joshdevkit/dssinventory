@extends('layouts.userapp')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-success">Request</h1>
                    </div>
                    <div class="col-sm-6">

                    </div>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <x-app-layout>
                    <div class="card card-success">
                        <div class="card-header">
                            <h2 class="card-title">Office Requisition</h2>
                        </div>
                        <div class="card-body">
                            <form id="requisition-form" method="POST" action="{{ route('office_user.selectCategory') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select class="form-control" id="category" name="category"
                                        onchange="this.form.submit()" required>
                                        <option value="">Select a category</option>
                                        <option value="equipments"
                                            {{ session('category') == 'equipments' ? 'selected' : '' }}>Equipments
                                        </option>
                                        <option value="supplies" {{ session('category') == 'supplies' ? 'selected' : '' }}>
                                            Supplies
                                        </option>
                                    </select>
                                </div>
                            </form>

                            @if (session('category'))
                                <form action="{{ route('office_user.store') }}" method="POST">
                                    @csrf
                                    <div class="form-row mb-3">
                                        <div class="col-md-6">
                                            <label for="user_name">Name</label>
                                            <input type="text" class="form-control" value="{{ Auth::user()->name }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <input type="hidden" name="category" value="{{ ucfirst(session('category')) }}">
                                    <div id="items">
                                        <div class="item-row">
                                            <div class="form-row">
                                                <div class="col-md-6 form-group">
                                                    <label for="item">Item</label>
                                                    <select id="selectedInitial" class="form-control"
                                                        name="items[0][item_id]" required>
                                                        <option value="">Select an item</option>
                                                        @if (session('items'))
                                                            @foreach (session('items') as $item)
                                                                <option value="{{ $item['id'] }}"
                                                                    data-quantity="{{ $item['count'] }}">
                                                                    {{ $item['item'] }} ({{ $item['count'] }} available)
                                                                </option>
                                                            @endforeach
                                                        @else
                                                            <option value="">No items available</option>
                                                        @endif

                                                    </select>
                                                </div>
                                                <div class="col-md-3 form-group">
                                                    <label for="quantity">Quantity</label>
                                                    <input type="number" class="form-control quantity-input" id="qty-0"
                                                        name="items[0][quantity]" required data-max-quantity="0"
                                                        min="0">
                                                    <input type="hidden" name="items[0][actual_quantity]" id="hidden-qty-0"
                                                        value="0">
                                                </div>


                                                <div class="col-md-3 form-group align-self-end">
                                                    <x-danger-button type="button"
                                                        class="btn btn-danger remove-item">Remove</x-danger-button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <x-primary-button type="button" class="btn btn-secondary add-item mb-3">Add
                                                Another Item</x-primary-button>
                                        </div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="purpose">Purpose</label>
                                        <textarea class="form-control" id="purpose" name="purpose" rows="4" required></textarea>
                                    </div>
                                    <x-primary-button type="submit" class="btn btn-primary">Submit</x-primary-button>
                                </form>
                            @endif

                        </div>
                    </div>
                </x-app-layout>
            </div>
        </div>
    </div>



@endsection
@section('sctipts')
    <script>
        $(document).ready(function() {


            //prevent negative input
            $(".quantity-input").on("input", function() {
                if ($(this).val() <= 0) {
                    $(this).val(1);
                }
            });

            let itemIndex = 1;

            function updateMaxQuantity(selectElement) {
                const selectedOption = $(selectElement).find('option:selected');
                const maxQuantity = selectedOption.data('quantity'); // Access data-quantity attribute

                if (maxQuantity !== undefined) {
                    const itemIndex = $(selectElement).closest('.item-row').find('input.quantity-input').attr('id')
                        .split('-')[1];

                    $(`#qty-${itemIndex}`).attr('data-max-quantity', maxQuantity);
                    $(`#hidden-qty-${itemIndex}`).val(maxQuantity);
                }
            }


            // Bind the change event to handleitem selection
            function handleSelectChange(selectElement) {
                selectElement.on('change', function() {
                    updateMaxQuantity($(this));
                });
            }

            function handleQuantityValidation() {
                $(document).on('input', '.quantity-input', function() {
                    const $this = $(this);
                    const maxQuantity = parseInt($this.attr('data-max-quantity'), 10);
                    const enteredQuantity = parseInt($this.val(), 10);

                    if (enteredQuantity > maxQuantity) {
                        alert('Quantity cannot exceed available stock.');
                        $this.val(maxQuantity);
                    }
                });
            }

            const initialSelect = $('#items select[name="items[0][item_id]"]');

            updateMaxQuantity(initialSelect);

            handleSelectChange(initialSelect);

            handleQuantityValidation();

            $('.add-item').on('click', function() {
                const itemRow = `
    <div class="item-row">
        <div class="form-row">
            <div class="col-md-6 form-group">
                <label for="item">Item</label>
                <select class="form-control item-select" name="items[${itemIndex}][item_id]" required>
                    <option value="">Select an item</option>
                    @if (session('items') && count(session('items')) > 0)
                        @foreach (session('items') as $item)
                            <option value="{{ $item['id'] }}" data-quantity="{{ $item['count'] }}">{{ $item['item'] }} ({{ $item['count'] }} available)</option>
                        @endforeach
                    @else
                        <option value="">No items available</option>
                    @endif
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label for="quantity">Quantity</label>
                <input type="number" id="qty-${itemIndex}" class="form-control quantity-input" name="items[${itemIndex}][quantity]" required data-max-quantity="0">
                <input type="hidden" name="items[${itemIndex}][actual_quantity]" id="hidden-qty-${itemIndex}" value="0">
            </div>
            <div class="col-md-3 form-group align-self-end">
                <x-danger-button type="button" class="btn btn-danger remove-item">Remove</x-danger-button>
            </div>
        </div>
    </div>
    `;

                $('#items').append(itemRow);
                const newSelect = $(`#items select[name="items[${itemIndex}][item_id]"]`);

                handleSelectChange(newSelect);
                handleQuantityValidation();

                itemIndex++;
            });


            $(document).on('click', '.remove-item', function() {
                $(this).closest('.item-row').remove();
            });
        });
    </script>
@endsection
