<?php

function my_form()
{

?> <h1 class="heading">Content Calender</h1>
	<form action="" method="POST">

		<div>
			<label for="date">Date :</label>
			<input type="date" name="date" id="name" required />
		</div>

		<div>
			<label for="occasion">Occasion :</label>
			<input type="text" name="occasion" id="occasion" required />
		</div>

		<div>
			<label for="post-title">Post Title :</label>
			<input type="text" name="post-title" id="post-title" required />
		</div>

		<div>
			<label for="author">Author :</label>

			<select id="author" name="author">
				<?php
				$users = get_users();
				foreach ($users as $user) {
					echo '<option value="' . $user->ID . '">' . $user->display_name . '</option>';
				}
				?>
			</select>

		</div>

		<div>
			<label for="reviewer">Reviewer :</label>
			<select id="reviewer" name="reviewer">
				<?php
				$users = get_users(array('role__not_in' => array('administrator')));
				foreach ($users as $user) {
					echo '<option value="' . $user->ID . '">' . $user->display_name . '</option>';
				}
				?>
			</select>

		</div>

		<div>
			<?php submit_button('Submit'); ?>

		</div>


	</form>
<?php


}


//To save data in options table
function save_data()
{
    if (isset($_POST['submit'])) {
        $options = get_option('my_plugin_options', array());
        if (!empty($options)) {
            $options = maybe_unserialize($options);
        }

        $new_options = array(
            'date' => $_POST['date'],
            'occasion' => $_POST['occasion'],
            'post_title' => $_POST['post-title'],
            'author' => $_POST['author'],
            'reviewer' => $_POST['reviewer'],
        );

		// Check if the same date and occasion already exist in the options table
        foreach ($options as $option) {
            if ($option['date'] === $_POST['date'] && $option['occasion'] === $_POST['occasion']) {
				echo "<script>alert('Duplicate entry exists.');</script>";
                return;
            }
        }

		// Adding data into array
        $options[] = $new_options;
        $serialized_options = maybe_serialize($options);
        update_option('my_plugin_options', $serialized_options);
    }
}

//To display data in table format
function display_table()
{
    $calendar_data = get_option('my_plugin_options', array());
   
    $data_array = maybe_unserialize($calendar_data);
    
    echo '<table id="data_table">';
    echo '<thead><tr><th>Date</th><th>Occasion</th><th>Post Title</th><th>Author</th><th>Reviewer</th></tr></thead>';
    echo '<tbody>';

    foreach ($data_array as $item_array) {
        echo '<tr>';
        echo '<td>' . date("d-m-Y", strtotime($item_array['date'])) . '</td>';
        echo '<td>' . $item_array['occasion'] . '</td>';
        echo '<td>' . $item_array['post_title'] . '</td>';
        echo '<td>' . get_the_author_meta('display_name', $item_array['author']) . '</td>';
        echo '<td>' . get_the_author_meta('display_name', $item_array['reviewer']) . '</td>';
        echo '</tr>';
    }

    echo '</tbody></table>';
}