import { isNull } from "util";

/*
    TODO: Compile this code and debug it for
        release

*/

///@brief defines the tab displayed name
var tabName = "BDE-CESI Back";

var express = require('express');

class CesiRoute {
    private m_MaxLength: number;
    private m_DefaultValue: string;
    private m_Root: string;
    private m_Router;

    public constructor(router, root: string, length: number, defaultValue: string) {
        this.m_Root = root;
        this.m_MaxLength = length;
        this.m_DefaultValue = defaultValue;
    }

    public get(fnc) : CesiRoute {
        for(var i=0; i<this.m_MaxLength; i++) {
            var paramsPath='';
            for(var n=0; n<i; ++n) {
                paramsPath+=('/:p'+n);
            }
            this.m_Router.get(this.m_Root+paramsPath, fnc)
        }
        return this;
    }
}

export class CesiRouter {
    private static INSTANCE: CesiRouter;
    private static router;

    private constructor() {
        CesiRouter.router = express.Router();
        CesiRouter.router.get('/', function(req, res, next) {
            res.render('index', { title: tabName });
          });
    }

    public addRoute(root: string, maxLength: number, defaultValue: string) : CesiRoute {
        return new CesiRoute(CesiRouter.router, root, maxLength, defaultValue);
    }

    public getRouter() {
        return CesiRouter.router;
    }

    public static get Instance() {
        return this.INSTANCE || (this.INSTANCE = new this());
    }

}


