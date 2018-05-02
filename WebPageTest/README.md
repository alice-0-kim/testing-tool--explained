# Web Page Test
```php
public function iReadFile($arg1)
{
  //available options:
  $connectivities = ['Cable', '3G'];
  $locations = ['Dulles:Chrome', 'gce-us-west1-linux:Chrome'];
  //writes column titles
  $myfile = fopen("pre-migration-record.csv", "a") or die("Unable to open file!");
  $txt = "SITE ID,PRIORITY,SITE URL,TEST ID,TEST RESULT" . "\n";
  fwrite($myfile, $txt);
  fclose($myfile);

  $myfile = fopen($arg1, "r") or die("Unable to open file!");
  while (!feof($myfile)) {
    $line = fgets($myfile, filesize($arg1));
    $parsed = explode(",", $line);
    //available variables:
    $site_id = $parsed[0];
    $priority = $parsed[1];
    $site_url = $parsed[2];
    if (strcmp($priority, "P1") === 0 || strcmp($priority, "P2") === 0) {
      foreach ($connectivities as $c) {
        foreach ($locations as $l) {
          $options = [
            'connectivity' => $c,
            'location' => $l,
            'firstViewOnly' => false,
            'runs' => 7,
            'video' => true,
          ];
          $this->iRunTest($site_id, $priority, $site_url, $options);
        }
      }
    }
  }
  fclose($myfile);
}
/**
 * Runs the test on https://www.webpagetest.org/
 */
public function iRunTest($site_id, $priority, $site_url, $options) {
  $wpt = new WebPageTest('A.6b5f5d012e122cecb63343246689eb8e');
  if ($response = $wpt->runTest($site_url, $options)) {
    if ($response->statusCode == StatusCode::OK) {
      // All test info is available in $response->data.
      $test_id = $response->data->testId;
      $user_url = $response->data->userUrl;
      var_dump($response->data);
      $this->iWriteFile($site_id, $priority, $site_url, $test_id, $user_url);
    } else {
      echo $response->statusCode;
    }
  }
}
/**
 * Writes or appends to the file with the given url
 */
public function iWriteFile($site_id, $priority, $site_url, $test_id, $user_url) {
  echo $site_url;
  echo $user_url;
  $myfile = fopen("pre-migration-record.csv", "a") or die("Unable to open file!");
  $txt = $site_id .",". $priority .",". $site_url .",". $test_id .",". $user_url . "\n";
  fwrite($myfile, $txt);
  fclose($myfile);
}
```
