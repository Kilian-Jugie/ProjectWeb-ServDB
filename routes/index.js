var express = require('express');
var router = express.Router();
var bodyParser = require('body-parser');
var app = express();
var execPhp = require('exec-php');
var utils = require('./utils');
var cesiRouter = require('../build/cesi_router');

app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

/*router.get('/', function(req, res, next) {
  res.render('index', { title: 'Express' });
});

router.use(bodyParser.json());

router.all('/api/:table/:key', function(req, res) {
  execPhp("../public/api/API.php", "php", function(error, php, output){
    if(error) {
      res.send(utils.formatExecPhpError(error));
      return;
    }

    php.api_main(req.method, req.params, req.body, function(err, result, output, printed) {
      if(err) {
        res.send(utils.formatExecPhpError(err));
      }
      else
        res.send(printed);
    });
  });
  
});*/

router.use(bodyParser.json());

crouter = cesiRouter.CesiRouter.Instance();

crouter.addRoute("/api", 3).all(function (req, res) {
  try {
  execPhp("../public/api/API.php", "php", function (error, php, output) {
    if (error) {
      res.send(error);
    }
    else {
      php.api_main(req.method, req.params, req.body, function (err, result, output, printed) {
        if (err) {
          var toDisplay = "\n===== BEGIN OF PHP ERROR REPORT =====\n";
          toDisplay += err;
          toDisplay += "\n===== END OF ERROR REPORT =====\n";
          res.send(toDisplay);
        }
        else
          res.send(printed);
      });
    }
  });
}
catch(err) {
  var toDisplay = "===== GENERAL ERROR REPORT =====\n";
  toDisplay += err;
  toDisplay += "\n===== END OF ERROR REPORT =====\n";
  res.send(toDisplay);
}

});

module.exports = crouter.getRouter();
