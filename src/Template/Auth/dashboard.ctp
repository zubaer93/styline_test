<html>
<head>
</head>
<body>
<p>
   This is your dashboard
</p>
<p>
<table style="width:100%">
    <tr>
        <th>Index</th>
        <th>Repository</th>
        <th>Commit</th>
        <th>Author Name</th>
        <th>Author Email</th>
    </tr>
    <?php foreach ($webhook_data as $key => $val): ?>
        <tr>
            <td>
                <?= $key+1; ?>
            </td>
            <td>
                <?= $val['repository']; ?>
            </td>
            <td>
                <?= $val['commit']; ?>
            </td>
            <td>
                <?= $val['author_name']; ?>
            </td>
            <td>
                <?= $val['author_email']; ?>
            </td>
        </tr>
    <?php endforeach ?>
</table>
</p>
</body>
</html>