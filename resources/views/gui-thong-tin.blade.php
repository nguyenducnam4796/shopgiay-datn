<form action="" method="POST">
    <table>
        <tr>
            <td>HỌ và tên</td>
            <td><input type="text" name="full_name"></td>
        </tr>
        <tr>
            <td colspan="2"><button type="submit">Gửi thông tin</button></td>
        </tr>
    </table>
    {{ csrf_field() }}
</form>