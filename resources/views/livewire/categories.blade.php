<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="multiple-border">Categories & Sub-Categories</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card border border-dark-subtle">
                    <div class="card-header border-info-subtle d-flex align-items-center justify-content-between">
                        <h5 class="m-0 px-auto">Featured</h5>
                        <button class="btn btn-info px-2" data-bs-toggle="modal" data-bs-target="#categories_modal">Add
                            category</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 bg-white">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Category name</th>
                                        <th>Number of Subcategory</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable_category">
                                    @forelse ($categories as $category)
                                        <tr data-index="{{ $category->id }}" data-ordering="{{ $category->ordering }}">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    {{ $category->category_name }}
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-muted">{{ $category->subcategories->count() }}</p>
                                            </td>
                                            <td>
                                                <a href="#" wire:click.prevent="editCategory({{ $category->id }})"
                                                    data-bs-toggle="modal" data-bs-target="#categories_modal"
                                                    class="btn btn-outline-success btn-sm btn-rounded fw-bold">
                                                    Edit
                                                </a>
                                                <button type="button"
                                                    wire:click.prevent="deleteCategory({{ $category->id }})"
                                                    class="btn btn-outline-danger btn-sm btn-rounded fw-bold">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            <p class="p-0 m-0">No Category Found.</p>
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card border border-dark-subtle">
                    <div class="card-header border-info-subtle d-flex align-items-center justify-content-between">
                        <h5 class="m-0 px-auto">Featured</h5>
                        <a href="#" class="btn btn-info px-2" data-bs-toggle="modal"
                            data-bs-target="#subcategories_modal">Add Subcategory</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 bg-white">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Subcategory name</th>
                                        <th>Parent Category</th>
                                        <th>N. of posts</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable_subcategory">
                                    @forelse ($subcategories as $subcategory)
                                        <tr data-index="{{ $subcategory->id }}"
                                            data-ordering="{{ $subcategory->ordering }}">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    {{ $subcategory->subcategory_name }}
                                                </div>
                                            </td>
                                            <td>
                                                <p class="fw-normal mb-1">
                                                    {{ $subcategory->parent_category != 0 ? $subcategory->parentCategory->category_name : ' Uncategorized ' }}
                                                </p>
                                            </td>
                                            <td>{{ $subcategory->posts->count() }}</td>
                                            <td>
                                                <a href="#"
                                                    wire:click.prevent="editSubCategory({{ $subcategory->id }})"
                                                    data-bs-toggle="modal" data-bs-target="#subcategories_modal"
                                                    class="btn btn-outline-success btn-sm btn-rounded fw-bold">
                                                    Edit
                                                </a>
                                                <a href="#"
                                                    wire:click.prevent="deleteSubCategory({{ $subcategory->id }})"
                                                    class="btn btn-outline-danger btn-sm btn-rounded fw-bold">
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            <p class="p-0 m-0">No SubCategory Found.</p>
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="categories_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form
                    @if ($updateCategoryMode) wire:submit.prevent="updateCategory" @else wire:submit.prevent="addCategory" @endif
                    method="POST">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                            {{ $updateCategoryMode ? 'Update Category' : 'Add Category' }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if ($updateCategoryMode)
                            <input type="hidden" wire:model="selected_category_id">
                        @endif
                        <div class="mb-3">
                            <div class="form-label">Category name</div>
                            <input type="text" class="form-control" wire:model="category_name"
                                placeholder="Enter category name..." />
                            @error('category_name')
                                <span class="text-danger fw-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            wire:click.prevent="resetInputForm">Close</button>
                        <button type="submit"
                            class="btn btn-primary">{{ $updateCategoryMode ? 'Update' : 'Save' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal subcategories -->
    <div wire:ignore.self class="modal fade" id="subcategories_modal" tabindex="-1" data-bs-backdrop="static"
        data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content"
                @if ($updateSubCategoryMode) wire:submit.prevent="updateSubCategory()" @else wire:submit.prevent="addSubCategory()" @endif
                method="POST">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        {{ $updateSubCategoryMode ? 'Update SubCategory' : 'Add SubCategory' }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($updateSubCategoryMode)
                        <input type="hidden" wire:model="selected_subcategory_id">
                    @endif
                    <div class="mb-3">
                        <label class="form-label" for="inlineFormSelectPref">Parent Category</label>
                        <select class="form-select" wire:model="parent_category">
                            <option value="0">-- Uncategorized --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('parent_category')
                            <span class="text-danger fw-bold">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-label">SubCategory name</div>
                        <input type="text" class="form-control" wire:model="subcategory_name"
                            placeholder="Enter Subcategory name..." />
                        @error('subcategory_name')
                            <span class="text-danger fw-bold">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary me-auto" data-bs-dismiss="modal"
                        wire:click.prevent="resetInputForm">Close</button>
                    <button type="submit"
                        class="btn btn-primary">{{ $updateSubCategoryMode ? 'Update' : 'Save' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $(window).on('hideCategoryModal', function(event) {
                $('#categories_modal').modal('hide');
            });
        });
        // window.addEventListener('hideCategoryModal', (event) => {
        //     $('#categories_modal').modal('hide')
        // })
        window.addEventListener('hideSubCategoryModal', (event) => {
            $('#subcategories_modal').modal('hide')
        })
        window.addEventListener('deleteCategory', function(event) {
            Swal.fire({
                icon: 'error',
                title: event.detail.title,
                html: event.detail.html,
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonText: "Cancel",
                confirmButtonText: "Yes, Delete?",
                cancelButtonColor: "#d33",
                confirmButtonColor: "#3085d6",
                width: 400,
                allowOutsideClick: false
            }).then(function(result) {
                if (result.value) {
                    window.livewire.emit('deleteCategoryAction', event.detail.id)
                }
            })
        });
        window.addEventListener('deleteSubCategory', function(event) {
            Swal.fire({
                icon: 'error',
                title: event.detail.title,
                html: event.detail.html,
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonText: "Cancel",
                confirmButtonText: "Yes, Delete?",
                cancelButtonColor: "#d33",
                confirmButtonColor: "#3085d6",
                width: 400,
                allowOutsideClick: false
            }).then(function(result) {
                if (result.value) {
                    window.livewire.emit('deleteCategoryAction', event.detail.id)
                }
            })
        });

        $('table tbody#sortable_category').sortable({
            update: function(event, ui) {
                $(this).children().each(function(index) {
                    if ($(this).attr('data-ordering') != (index + 1)) {
                        $(this).attr('data-ordering', (index + 1)).addClass('updated');
                    }
                });
                var positions = [];
                $(".updated").each(function() {
                    positions.push([$(this).attr('data-index'), $(this).attr('data-ordering')]);
                    $(this).removeClass('updated');
                });

                window.livewire.emit('updateCategoryOrdering', positions);
            }
        });

        $('table tbody#sortable_subcategory').sortable({
            update: function(event, ui) {
                $(this).children().each(function(index) {
                    if ($(this).attr('data-ordering') != (index + 1)) {
                        $(this).attr('data-ordering', (index + 1)).addClass('updated');
                    }
                });
                var positions = [];
                $(".updated").each(function() {
                    positions.push([$(this).attr('data-index'), $(this).attr('data-ordering')]);
                    $(this).removeClass('updated');
                });

                window.livewire.emit('updateSubCategoryOrdering', positions);
            }
        });
    </script>
@endpush
