@extends('welcome')
@section('content')
    <div class="container mt-5">
        <table class="table table-striped table-bordered" id="instructor">

            <thead class="table-dark">
                <tr>
                    <th>Instructor Name</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#instructor').DataTable({
                ajax: {
                    url: 'https://api-portal.mlgcl.edu.ph/api/external/employee-subjects',
                    type: 'GET',
                    headers: {
                        'x-api-key': '{{env("API_KEY")}}'
                    },
                    dataSrc: function(json) {
                        console.log('Data received:', json);
                        // Flatten the structure to get employees as separate rows
                        let employees = [];
                        let ids = new Set();
                        json.data.forEach(item => {
                            if (!ids.has(item.employee.id)) {
                                ids.add(item.employee.id);
                                employees.push({
                                    id: item.employee.id,
                                    full_name : [item.employee.first_name, item.employee.middle_name, item.employee.last_name].join(' '),
                                    image: item.employee.image
                                });
                            }
                        });
                        return employees;
                    }
                },
                columns: [
                    { data: 'full_name',
                        render: function(data, type, row){
                            console.log(row.id);
                            return `<a href="{{route('sched')}}?id=${row.id}" class="instructor-link" >${data}</a>`
                        }
                     },
                    {
                        data: 'image',
                        render: function(data, type, row) {
                            return data ? `<img src="${data}" alt="Profile Image" width="50" class="rounded-circle">` : 'No image';
                        }
                    }
                ]
            });
        });
    </script>

@endsection
