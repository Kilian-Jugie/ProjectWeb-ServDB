"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
/**
 * @file cesi_router.ts
 * @brief Abstract router and route to handle multiple route depth
 */
/**
 * @brief The index tab displayed name
 */
var tabName = "BDE-CESI Back";
var express = require('express');
/**
    @brief A route to a URI with functions to handle differents HTTP requests
*/
var CesiRoute = /** @class */ (function () {
    function CesiRoute(router, root, length) {
        this.m_Root = root;
        this.m_MaxLength = length;
        this.m_Router = router;
    }
    /*private add(method: any, fnc: any) : CesiRoute {
        //console.log("Setting get for route "+this.m_Root);
        for(var i=0; i<this.m_MaxLength; i++) {
            var paramsPath='';
            for(var n=0; n<i; ++n) {
                paramsPath+=('/:p'+n);
            }
            //console.log("Adding route: "+this.m_Root+paramsPath);
            method(this.m_Root+paramsPath, fnc)
        }
        return this;
    }*/
    /**
     * @brief Add route for all HTTP methods
     * @param fnc Handler with form: function(request, response) like express
     */
    CesiRoute.prototype.all = function (fnc) {
        //console.log("Setting get for route "+this.m_Root);
        for (var i = 0; i < this.m_MaxLength; i++) {
            var paramsPath = '';
            for (var n = 0; n < i; ++n) {
                paramsPath += ('/:p' + n);
            }
            //console.log("Adding route: "+this.m_Root+paramsPath);
            this.m_Router.all(this.m_Root + paramsPath, fnc);
        }
        return this;
    };
    return CesiRoute;
}());
/**
 * @brief An abstract router to manage different routes and
 * redirect request to the right function
 * Node: Implements the singleton pattern
 */
var CesiRouter = /** @class */ (function () {
    /**
     * TODO: Make the index route smarter and think about
     * its modularity
     */
    function CesiRouter() {
        CesiRouter.router = express.Router();
        CesiRouter.router.get('/', function (req, res, next) {
            res.render('index', { title: tabName });
        });
    }
    /**
     * @brief Create a new route from a root point with a maximum depth
     * @param root The root of the new root with format: /rootname
     * @param maxLength The maximum depth of the route
     */
    CesiRouter.prototype.addRoute = function (root, maxLength) {
        return new CesiRoute(CesiRouter.router, root, maxLength);
    };
    /**
     * @brief Get the configured express router
     */
    CesiRouter.prototype.getRouter = function () {
        return CesiRouter.router;
    };
    /**
     * @brief Get the singleton instance
     */
    CesiRouter.Instance = function () {
        return this.INSTANCE || (this.INSTANCE = new this());
    };
    return CesiRouter;
}());
exports.CesiRouter = CesiRouter;
