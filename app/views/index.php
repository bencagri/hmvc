Try Catch Restful CRUD operations Sample Task

<table border="1">
    <tr style="margin:10px">
        <td>Action</td>
        <td>Method)</td>
        <td>Url</td>
        <td>Required Params</td>
        <td>Optional Params</td>
    </tr>
    <tr>
        <td>List all users</td>
        <td>(GET)</td>
        <td>/actions</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Add new user</td>
        <td>(POST)</td>
        <td>/actions/add</td>
        <td><strong>name,email,number</strong></td>
        <td></td>
    </tr>
    <tr>
        <td>Update user</td>
        <td>(POST)</td>
        <td>/actions/update</td>
        <td><strong>id</strong></td>
        <td><strong>name,email,number</strong></td>
    </tr>

    <tr>
        <td>Delete users</td>
        <td>(POST)</td>
        <td>/actions/delete</td>
        <td><strong>id</strong></td>
        <td></td>
    </tr>
</table>


<?php if($users) : ?>
    <br />
    This is our users data.
    <pre>
    <?php print_r($users); ?>
    </pre>
<?php endif; ?>
