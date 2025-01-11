<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 flex justify-center space-x-4">
                        <button id="all-btn" onclick="filterTransactions('all')" class="w-1/5 px-4 py-2 bg-blue-500 text-white rounded border-4 border-transparent">All</button>
                        <button id="expense-btn" onclick="filterTransactions('expense')" class="w-1/5 px-4 py-2 bg-red-500 text-white rounded border-4 border-transparent">Expense</button>
                        <button id="income-btn" onclick="filterTransactions('income')" class="w-1/5 px-4 py-2 bg-green-500 text-white rounded border-4 border-transparent">Income</button>
                    </div>
                    <div id="transactions">
                        <!-- Transactions will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            loadTransactions('all');
        });

        function loadTransactions(type) {
            fetch(`/transactions?type=${type}`)
                .then(response => response.json())
                .then(data => {
                    const transactionsDiv = document.getElementById('transactions');
                    if (data.length === 0) {
                        transactionsDiv.innerHTML = '<p class="text-center text-gray-500">No transactions available.</p>';
                    } else {
                        transactionsDiv.innerHTML = `
                            <table class="min-w-full bg-white">
                                <thead>
                                    <tr class="bg-gray-500 text-white">
                                        <th class="py-2 text-center">Date</th>
                                        <th class="py-2 text-center">Type</th>
                                        <th class="py-2 text-center">Category</th>
                                        <th class="py-2 text-center">Description</th>
                                        <th class="py-2 text-center">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${data.map(transaction => `
                                        <tr>
                                            <td class="border px-4 py-2 text-center">${transaction.transaction_date}</td>
                                            <td class="border px-4 py-2 text-center">${transaction.category.type.charAt(0).toUpperCase() + transaction.category.type.slice(1)}</td>
                                            <td class="border px-4 py-2 text-center">${transaction.category.name}</td>
                                            <td class="border px-4 py-2">${transaction.description}</td>
                                            <td class="border px-4 py-2 text-right">$${transaction.amount}</td>
                                        </tr>
                                    `).join('')}
                                </tbody>
                            </table>
                        `;
                    }
                    setActiveButton(type);
                });
        }

        function filterTransactions(type) {
            loadTransactions(type);
        }

        function setActiveButton(type) {
            document.getElementById('all-btn').classList.remove('border-blue-700');
            document.getElementById('expense-btn').classList.remove('border-red-700');
            document.getElementById('income-btn').classList.remove('border-green-700');

            if (type === 'all') {
                document.getElementById('all-btn').classList.add('border-blue-700');
            } else if (type === 'expense') {
                document.getElementById('expense-btn').classList.add('border-red-700');
            } else if (type === 'income') {
                document.getElementById('income-btn').classList.add('border-green-700');
            }
        }
    </script>
</x-app-layout>
