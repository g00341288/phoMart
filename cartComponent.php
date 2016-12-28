<table class="table table-bordered table-striped">
          <thead>

            <tr>
              <th>Remove</th>
              <th>Image</th>
              <th>Product Name</th>
              <th>Unit Price</th>
              <th>Total</th>
            </tr>

          </thead>

          <tbody>

            <tr ng-repeat="item in cart track by $index">

              <!-- Remove product checkbox -->
              <td class="muted center_text">
                <button class="btn btn-danger" ng-click="remove(item,$index)">
                  <span class="glyphicon glyphicon-remove"></span>
                </button>
              </td>

              <!-- Image -->
              <td class="muted center_text">
                <a href="home.php">
                  <img class="img-thumbnail" title="" src="{{item.image_0}}" style="width: 60px; height: auto">
                </a>
              </td>

              <!-- Product Name --> 
              <td class="muted center_text">{{item.name}}</td>

              <!-- Unit Price -->
              <td class="muted center_text">{{item.price | currency:"€"}}</td>

              <!-- Item Total -->
              <td class="muted center_text">{{item.price | currency:"€" }}</td>

            </tr> 

            <!-- Order Total -->
            <tr>

              <td></td>
              <td></td>
              <td></td>
              <td></td>
              
              <td ng-model="order">
                <strong>{{order.total | currency:"€"}}</strong>
              </td>

            </tr>  

          </tbody>

        </table>