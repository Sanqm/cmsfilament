<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome Blade</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div>
        @foreach ($posts as $post)
        <table class="table-auto table-fixed container">
          
           <thead>
            <tr>
              <th>Título</th>
              <th>Mensaje</th>
              <th>Imagen</th>
            </tr>
          </thead>
         
            <tr>
              <td>{{$post->title}}</td>
              <td>{{$post->body}}</td>
              <td>{{$post->imgage_url}}</td>
            </tr>
        
           @endforeach
            
            
          </table>
    </div>
    
</body>
</html>