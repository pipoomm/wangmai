<?php 
include_once('connect.php');

if(isset($_GET['room_id']))
{

}
else
{
    $sql = "SELECT * FROM `room` ";
    $query = mysqli_query($connect, $sql);
    $installed = array("517","321");
    while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        if (in_array($result['room_id'], $installed)) 
        {
        echo '
        <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs/dist/tf.min.js"> </script>
            <script type="text/javascript">
            class wang_predictor
            {
                constructor(height, width) {
                    this.model = tf.loadLayersModel("/predict/517/model.json");
                }
                predict(data)
                {
                    return this.model.then(model => {
                        let pred_res = model.predict(tf.tensor(data));
                        return pred_res.round().dataSync();
                    })
                }
            }
            const wp = new wang_predictor(); //run once!
            let v1 = false;
            let v2 = false;
            let v3 = false;
            let new_to_predict_data = false;
        </script>';
    
            $sql1 = "SELECT light,temp,sound,uploadtime FROM sensors WHERE room_id='" .$result['room_id']."' ORDER BY uploadtime DESC LIMIT 10";
            $query1 = mysqli_query($connect, $sql1);
                $avg_sound = 0;
                $avg_temp = 0;
                $avg_light = 0;
                while ($value = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
                    $avg_sound += $value['sound'];
                    $avg_temp += $value['temp'];
                    $avg_light += $value['light'];
                }
                $avg_sound = $avg_sound / 10;
                $avg_temp = $avg_temp / 10;
                $avg_light = $avg_light / 10;
    
                echo '<script>
                v1 = '.$avg_light.';
                v2 = '.$avg_temp.';
                v3 = '.$avg_sound.';
                new_to_predict_data = [ [v1, v2, v3] ];
                wp.predict(new_to_predict_data).then((result) => {
                    $.ajax({
                        url: "sensor_criteria.php",
                        type: "POST",
                        data: {
                            room_id: '.$result['room_id'].',
                            light: '.$avg_light.',
                            temp: '.$avg_temp.',
                            sound: '.$avg_sound.',
                            status: result[0],
                        },
                        success: function(data) {
                                console.log(data);
                            }
                        });
                    });
                </script>';
        }
        else
        {
            echo '
            <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs/dist/tf.min.js"> </script>
            <script type="text/javascript">
            class wang_predictor
            {
                constructor(height, width) {
                    this.model = tf.loadLayersModel("/predict/517/model.json");
                }
                predict(data)
                {
                    return this.model.then(model => {
                        let pred_res = model.predict(tf.tensor(data));
                        return pred_res.round().dataSync();
                    })
                }
            }
            const wp = new wang_predictor(); //run once!
            let v1 = false;
            let v2 = false;
            let v3 = false;
            let new_to_predict_data = false;
        </script>';
    
            $sql1 = "SELECT light,temp,sound,uploadtime FROM sensors WHERE room_id='" .$result['room_id']."' ORDER BY uploadtime DESC LIMIT 10";
            $query1 = mysqli_query($connect, $sql1);
                $avg_sound = 0;
                $avg_temp = 0;
                $avg_light = 0;
                while ($value = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
                    $avg_sound += $value['sound'];
                    $avg_temp += $value['temp'];
                    $avg_light += $value['light'];
                }
                $avg_sound = $avg_sound / 10;
                $avg_temp = $avg_temp / 10;
                $avg_light = $avg_light / 10;
    
                echo '<script>
                v1 = '.$avg_light.';
                v2 = '.$avg_temp.';
                v3 = '.$avg_sound.';
                new_to_predict_data = [ [v1, v2, v3] ];
                wp.predict(new_to_predict_data).then((result) => {
                    $.ajax({
                        url: "sensor_criteria.php",
                        type: "POST",
                        data: {
                            room_id: '.$result['room_id'].',
                            light: '.$avg_light.',
                            temp: '.$avg_temp.',
                            sound: '.$avg_sound.',
                            status: result[0],
                        },
                        success: function(data) {
                            console.log(data);
                            }
                        });
                    });
                </script>';
        }
    }
}
?>