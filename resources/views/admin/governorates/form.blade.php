<div class="card">

    <div class="card-body">

        <div class="row">

            <!-- Name -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    اسم المحافظة
                </label>

                <input type="text"
                       name="name"
                       value="{{ old('name', $governorate->name ?? '') }}"
                       class="form-control @error('name') is-invalid @enderror">

                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <!-- Status -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    الحالة
                </label>

                <select name="status"
                        class="form-select">

                    <option value="1"
                        {{ old('status', $governorate->status ?? 1) == 1 ? 'selected' : '' }}>
                        نشط
                    </option>

                    <option value="0"
                        {{ old('status', $governorate->status ?? 1) == 0 ? 'selected' : '' }}>
                        غير نشط
                    </option>

                </select>

            </div>

            <div class="col-md-12 mb-3">

                <label class="form-label">
                    التجمعات السكانية
                </label>

                <textarea name="population_communities"
                          rows="6"
                          class="form-control @error('population_communities') is-invalid @enderror"
                          placeholder="أدخل كل تجمع سكاني في سطر مستقل">{{ old('population_communities', isset($governorate) ? $governorate->populationCommunities->pluck('name')->implode("\n") : '') }}</textarea>

                @error('population_communities')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

        </div>

    </div>

    <div class="card-footer text-end">

        <button class="btn btn-primary">

            {{ $button ?? 'حفظ' }}

        </button>

    </div>

</div>
