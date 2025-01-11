<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-4">Add New Transaction</h2>
                    <form action="{{ route('transactions.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="type" class="block text-gray-700">Type</label>
                            <select name="type" id="type" class="w-full px-4 py-2 border rounded" required>
                                <option value="expense">Expense</option>
                                <option value="income">Income</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="category_id" class="block text-gray-700">Category</label>
                            <select name="category_id" id="category_id" class="w-full px-4 py-2 border rounded" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" data-type="{{ $category->type }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="amount" class="block text-gray-700">Amount</label>
                            <input type="number" step="0.01" name="amount" id="amount" class="w-full px-4 py-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700">Description</label>
                            <input type="text" name="description" id="description" class="w-full px-4 py-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="transaction_date" class="block text-gray-700">Transaction Date</label>
                            <input type="date" name="transaction_date" id="transaction_date" class="w-full px-4 py-2 border rounded" required>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Add Transaction</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('type').addEventListener('change', function() {
            var type = this.value;
            var categorySelect = document.getElementById('category_id');
            var options = categorySelect.querySelectorAll('option');
            options.forEach(function(option) {
                option.style.display = option.getAttribute('data-type') === type ? 'block' : 'none';
            });
            categorySelect.value = '';
        });
        document.getElementById('type').dispatchEvent(new Event('change'));
    </script>
</x-app-layout>
