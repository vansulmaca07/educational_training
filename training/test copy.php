<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" 
          content="width=device-width, 
                   initial-scale=1.0">
    <title>
        Document
    </title>
    <link href=
"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
          rel="stylesheet">
</head>

<body>
    <div class="dropdown m-4">
        <button class="btn btn-secondary 
                       dropdown-toggle" 
                type="button" 
                id="dropdownMenuButton1" 
                data-bs-toggle="dropdown" 
                aria-expanded="false">
            Dropdown button
        </button>
        <ul class="dropdown-menu pt-0" 
            aria-labelledby="dropdownMenuButton1">
            <input type="text" 
                   class="form-control 
                          border-0 border-bottom 
                          shadow-none mb-2" 
                   placeholder="Search..." 
                   oninput="handleInput()">
        </ul>
    </div>
    <script src="./script.js"></script>
    <script src=
"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">

    </script>
</body>

</html>