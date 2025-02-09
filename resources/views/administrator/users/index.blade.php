<x-app-layout>
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 dark:text-white">
        <div class="flex flex-col md:flex-row text-center justify-between gap-4">
            <h1 class="text-xl md:text-2xl font-semibold">Data Pengguna</h1>
            <button class="btn btn-success bg-green-500 text-white rounded-lg px-4 py-2 mb-4"
                id="addNewDataButton">Registrasi Pengguna</button>
        </div>
        <table class="min-w-full bg-white divide-y divide-gray-200 border" id="dataTables">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Role
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Action
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white text-black divide-y divide-gray-200 text-center"></tbody>
        </table>
    </div>
    <div id="dataModal" class="fixed inset-0 flex items-center justify-center z-[1100] hidden bg-black bg-opacity-50">
        <!-- Modal Content -->
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-auto p-6">
            <h2 id="modalTitle" class="text-2xl font-semibold mb-4"></h2>
            <!-- Form Inputs -->
            <form id="dataForm" autocomplete="off">
                <input type="hidden" id="recordId" name="id">
                <input type="hidden" id="method" name="method">

                <div class="flex flex-col w-full mb-2">
                    <label for="name" class="block text-gray-700">Nama</label>
                    <input type="text" id="name" name="name" class="border shadow-sm rounded-md py-2 px-3">
                </div>

                <div class="flex flex-col w-full mb-2">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="border shadow-sm rounded-md py-2 px-3">
                </div>

                <div id="pass" class="flex flex-col w-full mb-2">
                    <label for="phone_number" class="block text-gray-700">Password</label>
                    <input type="password" id="password" maxlength="15" name="password"
                        class="border shadow-sm rounded-md py-2 px-3">
                </div>

                <div class="flex flex-col w-full mb-4">
                    <label for="role" class="block text-gray-700">Jabatan</label>
                    <select id="role" name="role" class="border shadow-sm rounded-md py-2 px-3">
                        <option value="">Pilih Jabatan</option>
                        <option value="admin">Administrator</option>
                        <option value="guru">Guru</option>
                    </select>
                </div>

                <!-- Modal Buttons -->
                <div class="flex justify-end">
                    <button type="button" id="close-modal"
                        class="bg-gray-500 text-white rounded-lg px-4 py-2 mr-2">Batal</button>
                    <button type="button" id="save"
                        class="bg-blue-500 text-white rounded-lg px-4 py-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(function() {
            $('#dataTables').DataTable({
                ajax: '{!! route('admin.user.datatable') !!}',
                dom: '<"flex flex-row gap-2 md:items-center justify-between mb-4"<"flex items-center"l><"flex items-center"f>><"max-w-full h-fit overflow-x-auto md:overflow-x-visible"rt><"flex items-center justify-between mt-4"<""i><"flex items-center"p>>',
                lengthMenu: [10, 25, 50],
                pagingType: 'simple',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        width: 40
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'roleCast',
                        name: 'roleCast'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: 73
                    }
                ],
                initComplete: function() {
                    $('#dataTables_length label:contains("Show")').contents().filter(function() {
                        return this.nodeType === 3 && this.nodeValue.trim() === "Show";
                    }).remove();

                    $('#dataTables_length label:contains("entries")').contents().filter(function() {
                        return this.nodeType === 3 && this.nodeValue.trim() === "entries";
                    }).remove();

                    $('#dataTables_filter label:contains("Search:")').contents().filter(function() {
                        return this.nodeType === 3 && this.nodeValue.trim() === "Search:";
                    }).remove();

                    $('#dataTables_length select')
                        .addClass('border border-gray-300 rounded-lg p-2 text-black')
                        .css('width', '80px');

                    $('#dataTables_filter input')
                        .addClass('border border-gray-300 rounded-lg p-2 text-black')
                        .attr('placeholder', 'Search...')
                        .css('display', 'inline-block');

                    $('.paginate_button')
                        .addClass(
                            'border border-gray-300 rounded-lg p-2 mx-1 hover:bg-gray-200'
                        );

                }
            });
        });
    </script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#addNewDataButton').click(function() {
                $('#modalTitle').text('Registrasi Pengguna');
                $('#dataModal').removeClass('hidden');
                $("#method").val('POST');
                $('#dataForm')[0].reset();
                $('#pass').removeClass('hidden');
            });

            $('#close-modal').click(function() {
                $('#dataModal').addClass('hidden');
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#save').click(function(e) {
                e.preventDefault();
                $(this).prop('disabled', true).html(
                    '<span class="mr-2">Simpan</span><i class="fa fa-spinner fa-pulse fa-fw"></i>');

                const method = $("#method").val() === 'PUT' ? 'PUT' :
                    'POST';
                const url = method === "POST" ? "{{ route('admin.user.store') }}" :
                    "{{ route('admin.user.update') }}";

                $.ajax({
                    url: url,
                    type: method,
                    data: $("#dataForm").serialize(),
                    success: function(res) {
                        success(res.message);
                        $('#dataTables').DataTable().ajax.reload();
                        $('#dataForm')[0].reset();
                        $('#dataModal').addClass('hidden');
                    },
                    error: function(err) {
                        handleError(err);
                    },
                    complete: function() {
                        $('#save').prop('disabled', false).text('Simpan');
                    }
                });
            });

            $('table#dataTables tbody').on('click', 'td button', function(e) {
                const action = $(this).attr("data-mode");
                const data = $('#dataTables').DataTable().row($(this).parents('tr')).data();
                $('#modalTitle').text('Ubah Data Pengguna');

                if (action === 'edit') {
                    populateForm(data);
                    $("#method").val('PUT');
                    $('#pass').addClass('hidden');
                    $('#dataModal').removeClass('hidden');
                } else {
                    $('#pass').removeClass('hidden');
                    confirmDelete(data.id);
                }
            });

            function populateForm(data) {
                $("#recordId").val(data.id);
                $("#name").val(data.name);
                $("#email").val(data.email);
                $("#role").val(data.role);
            }

            function confirmDelete(id) {
                Swal.fire({
                    title: 'Kamu yakin ingin menghapus data ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Tidak, jangan!'
                }).then((result) => {
                    if (result.value) {
                        deleteRecord(id);
                    }
                });
            }

            function deleteRecord(id) {
                const data = {
                    id: id
                };
                $.ajax({
                    url: "{{ route('admin.user.destroy') }}",
                    type: 'DELETE',
                    data: data,
                    success: function(res) {
                        success(res.message);
                        $('#dataTables').DataTable().ajax.reload();
                    },
                    error: function(err) {
                        handleError(err);
                    }
                });
            }

            function handleError(err) {
                if (Array.isArray(err.responseJSON.message)) {
                    err.responseJSON.message.forEach(error);
                } else {
                    error(err.responseJSON.message);
                }
            }
        });
    </script>
</x-app-layout>
