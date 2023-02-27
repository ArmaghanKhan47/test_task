<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="items-center bg-transparent w-full border-collapse " id="data-table">
                        <thead>
                            <tr>
                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">ID</th>
                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">First Name</th>
                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Last Name</th>
                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Email</th>
                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                </div>
                <div class="p-6">
                    <x-primary-button class="ml-3" type="button" id="data-table-refresh-btn">
                        {{ __('Refresh') }}
                    </x-primary-button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            populateDataTable();

            document.getElementById('data-table-refresh-btn').addEventListener('click', function() {
                emptyDataTable();
                populateDataTable();
            });
        });

        function emptyDataTable() {
            const datatableEl = getDataTable();
            datatableEl.getElementsByTagName('tbody')[0].innerHTML = '';
        }

        async function populateDataTable() {
            const datatableEl = getDataTable();
            const datatableData = await fetchTableData();
            console.log(datatableData.data);
            const rows = Object.values(datatableData.data).map(row => Object.values(row));
            console.log(rows);

            const datatableBody = populateTableRow(rows);
            datatableEl.getElementsByTagName('tbody')[0].innerHTML = datatableBody;
        }

        function fetchTableData() {
            return window.axios.get('/table-data');
        }

        function getDataTable() {
            return document.getElementById('data-table');
        }

        function populateTableRow(rows) {
            function getTableCell(cell) {
                return [
                    '<td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">',
                        cell,
                    '</td>'
                ].join('');
            }

            function getTableRow(row) {
                let row_template = row.map(column => getTableCell(column));
                return [
                    '<tr>',
                        row_template.join(''),
                    '</tr>'
                ].join('');
            }

            return rows.map(row => getTableRow(row)).join('');
        }
    </script>
</x-app-layout>
