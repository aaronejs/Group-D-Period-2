<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php
    include './includes/header.php'; // header
    if(!isset($_SESSION['sessionID'])){
      header("location:./login.php?error=login");
    }
    ?>
      <main>
        <div class="schedule">
          <div class="tableWeek">
            <h1>WEEK 1</h1>
          </div>
          <div class="tableHeader">
            <table>
              <tr>
                <th>SUNDAY</th>
                <th>MONDAY</th>
                <th>TUESDAY</th>
                <th>WEDNESDAY</th>
                <th>THURSDAY</th>
                <th>FRIDAY</th>
                <th>SATURDAY</th>
              </tr>
            </table>
          </div>
          <div class="tableContent">
            <table>
              <tr>
                <td>
                  <h2>0.231</h2>
                  <p>IVAN IVANOV</p>
                  <p2>12:30 - 19:45</p2>
                </td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
              </tr>
              <tr>
                <td>
                  <h2>0.231</h2>
                  <p>IVAN IVANOV</p>
                  <p2>12:30 - 19:45</p2>
                </td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
              </tr>
              <tr>
                <td>
                  <h2>0.231</h2>
                  <p>IVAN IVANOV</p>
                  <p2>12:30 - 19:45</p2>
                </td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
              </tr>
              <tr>
                <td>
                  <h2>0.231</h2>
                  <p>IVAN IVANOV</p>
                  <p2>12:30 - 19:45</p2>
                </td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
              </tr>
              <tr>
                <td>
                  <h2>0.231</h2>
                  <p>IVAN IVANOV</p>
                  <p2>12:30 - 19:45</p2>
                </td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
              </tr>
              <tr>
                <td>
                  <h2>0.231</h2>
                  <p>IVAN IVANOV</p>
                  <p2>12:30 - 19:45</p2>
                </td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
              </tr>
            </table>
          </div>

        </div>
      </main>
    <?php
    include './includes/footer.html'; // footer
    ?>
  </body>
</html>
