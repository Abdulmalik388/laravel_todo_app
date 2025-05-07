<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <style>
        /* Your existing CSS styles */
        .head {
            font-size: 70px;
            background-color: green;
            height: 130px;
            color: white;
            text-align: center;
        }

        .add_task {
            margin-left: 90%;
        }

        body {
            background-color: #f1f1f1;
        }

        .container1 {
            text-align: center;
        }

        .bytt {
            margin-left: auto;
        }

        .item {
            margin-left: 250px;
        }

        .nill {
            border: 1px solid #f1f1f1;
            background-color: white;
            border-radius: 5px;
            margin-top: 5px;
        }

        .p {
            margin-left: 20px;
        }

        .tem {
            margin-left: 300px;
        }

        .em {
            margin-left: 320px;
        }

        .delete {
            color: red;
        }

        .edit {
            color: green;
        }

        .main {
            display: flex;

        }

        .card {
            padding: 10px;
        }

            .table {
                margin-top: 20px;
            }
       
    </style>
</head>

<body>
    <h1 class="head">TODO APP</h1>
    <center>
        <div class="container1">
            <button class=" btn btn-success btn-lg">Today</button>
        </div>

        <!-- Today Tab Content -->
        <div class="tab-content container" id="tab1">
            <div class="add_task">
                <a href="{{ route('create') }}"><button class="btn btn-success bytt">Add Task</button></a>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Task</th>
                        <th>Timestamp</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($todos as $todo)
                        <tr>
                            <td>{{ $todo->task }}</td>
                            <td>{{ $todo->created_at->format('D M d Y, h:i A') }}</td>
                            <td>
                                <a href="{{ route('todo.edit', $todo->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <a href="{{ route('todo.destroy', $todo->id) }}" class="btn btn-sm btn-danger"
                                    onclick="event.preventDefault(); document.getElementById('delete-form-{{ $todo->id }}').submit();">Delete</a>
                                <form id="delete-form-{{ $todo->id }}" action="{{ route('todo.destroy', $todo->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Loop Through Tasks -->
           

        <!-- Pending and Overdue Tabs (currently not populated with data) -->


        <script>
            // Function to handle tab switching
            function openTab(tabIndex) {
                const contents = document.querySelectorAll('.tab-content');
                contents.forEach(content => content.classList.remove('active'));

                const buttons = document.querySelectorAll('.tab-button');
                buttons.forEach(button => button.classList.remove('active'));

                document.getElementById(`tab${tabIndex + 1}`).classList.add('active');
                buttons[tabIndex].classList.add('active');
            }

            openTab(0);

            // Toggle task status (checkbox change)
            function toggleStatus(id) {
                fetch(`/todos/${id}/status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ 'is_done': document.querySelector(`input[type="checkbox"][id="todo-${id}"]`).checked })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            toastr.success('Task status updated!');
                        } else {
                            toastr.error('Error updating task status.');
                        }
                    });
            }
        </script>

    </center>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"
    integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
    @elseif(Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
    @elseif(Session::has('info'))
        toastr.info("{{ Session::get('info') }}");
    @elseif(Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}");
    @endif
</script>

</html>