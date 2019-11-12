
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
class CesiRoute {
    /**
     * @brief The maximum depth of the URI
     */
    private m_MaxLength: number;
    /**
     * @brief The origin of the URI
     */
    private m_Root: string;
    /**
     * @brief The express router
     */
    private m_Router: any;

    public constructor(router: any, root: string, length: number) {
        this.m_Root = root;
        this.m_MaxLength = length;
        this.m_Router = router;
    }

    /**
     * @brief Add route for all HTTP methods
     * @param fnc Handler with form: function(request, response) like express
     */
    public all(fnc: any): CesiRoute {
        //console.log("Setting get for route "+this.m_Root);
        for(var i=0; i<this.m_MaxLength; i++) {
            var paramsPath='';
            for(var n=0; n<i; ++n) {
                paramsPath+=('/:p'+n);
            }
            //console.log("Adding route: "+this.m_Root+paramsPath);
            this.m_Router.all(this.m_Root+paramsPath, fnc);
        }
        return this;
    }
    
}

/**
 * @brief An abstract router to manage different routes and
 * redirect request to the right function
 * Node: Implements the singleton pattern
 */
export class CesiRouter {
    /**
     * @brief Singleton instance
     */
    private static INSTANCE: CesiRouter;
    /**
     * @brief The express router
     */
    private static router: any;

    /**
     * TODO: Make the index route smarter and think about
     * its modularity
     */
    private constructor() {
        CesiRouter.router = express.Router();
        CesiRouter.router.get('/', function(req: any, res: any, next: any) {
            res.render('index', { title: tabName });
          });
    }

    /**
     * @brief Create a new route from a root point with a maximum depth
     * @param root The root of the new root with format: /rootname
     * @param maxLength The maximum depth of the route
     */
    public addRoute(root: string, maxLength: number) : CesiRoute {
        return new CesiRoute(CesiRouter.router, root, maxLength);
    }

    /**
     * @brief Get the configured express router
     */
    public getRouter() : any {
        return CesiRouter.router;
    }

    /**
     * @brief Get the singleton instance
     */
    public static Instance() : CesiRouter {
        return this.INSTANCE || (this.INSTANCE = new this());
    }

}


