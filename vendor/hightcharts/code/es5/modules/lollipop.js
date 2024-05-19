/*
 Highcharts JS v11.1.0 (2023-06-05)

 (c) 2009-2021 Sebastian Bochan, Rafal Sebestjanski

 License: www.highcharts.com/license
*/
'use strict';(function(b){"object"===typeof module&&module.exports?(b["default"]=b,module.exports=b):"function"===typeof define&&define.amd?define("highcharts/modules/lollipop",["highcharts"],function(e){b(e);b.Highcharts=e;return b}):b("undefined"!==typeof Highcharts?Highcharts:void 0)})(function(b){function e(b,d,e,a){b.hasOwnProperty(d)||(b[d]=a.apply(null,e),"function"===typeof CustomEvent&&window.dispatchEvent(new CustomEvent("HighchartsModuleLoaded",{detail:{path:d,module:b[d]}})))}b=b?b._modules:
{};e(b,"Series/Lollipop/LollipopPoint.js",[b["Core/Series/SeriesRegistry.js"],b["Core/Utilities.js"]],function(b,d){var e=this&&this.__extends||function(){var b=function(a,c){b=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(b,a){b.__proto__=a}||function(b,a){for(var c in a)Object.prototype.hasOwnProperty.call(a,c)&&(b[c]=a[c])};return b(a,c)};return function(a,c){function d(){this.constructor=a}if("function"!==typeof c&&null!==c)throw new TypeError("Class extends value "+String(c)+
" is not a constructor or null");b(a,c);a.prototype=null===c?Object.create(c):(d.prototype=c.prototype,new d)}}(),a=b.seriesTypes,k=a.scatter.prototype.pointClass;a=a.dumbbell.prototype.pointClass;d=d.extend;b=function(b){function a(){var a=null!==b&&b.apply(this,arguments)||this;a.options=void 0;a.series=void 0;a.plotX=void 0;return a}e(a,b);return a}(b.series.prototype.pointClass);d(b.prototype,{destroy:a.prototype.destroy,pointSetState:k.prototype.setState,setState:a.prototype.setState});return b});
e(b,"Series/Lollipop/LollipopSeries.js",[b["Series/Lollipop/LollipopPoint.js"],b["Core/Series/SeriesRegistry.js"],b["Core/Series/Series.js"],b["Core/Utilities.js"]],function(b,d,e,a){var k=this&&this.__extends||function(){var b=function(a,f){b=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(b,a){b.__proto__=a}||function(b,a){for(var f in a)Object.prototype.hasOwnProperty.call(a,f)&&(b[f]=a[f])};return b(a,f)};return function(a,f){function c(){this.constructor=a}if("function"!==typeof f&&
null!==f)throw new TypeError("Class extends value "+String(f)+" is not a constructor or null");b(a,f);a.prototype=null===f?Object.create(f):(c.prototype=f.prototype,new c)}}(),h=d.seriesTypes,g=h.column.prototype;h=h.dumbbell.prototype;var c=a.extend,l=a.merge;a=function(b){function a(){var a=null!==b&&b.apply(this,arguments)||this;a.data=void 0;a.options=void 0;a.points=void 0;return a}k(a,b);a.prototype.drawPoints=function(){var a=this.points.length,c=0;for(b.prototype.drawPoints.apply(this,arguments);c<
a;){var d=this.points[c];this.drawConnector(d);c++}};a.defaultOptions=l(e.defaultOptions,{threshold:0,connectorWidth:1,groupPadding:.2,pointPadding:.1,states:{hover:{lineWidthPlus:0,connectorWidthPlus:1,halo:!1}},lineWidth:0,dataLabels:{align:void 0,verticalAlign:void 0},pointRange:1});return a}(e);c(a.prototype,{alignDataLabel:g.alignDataLabel,crispCol:g.crispCol,drawConnector:h.drawConnector,drawDataLabels:g.drawDataLabels,getColumnMetrics:g.getColumnMetrics,getConnectorAttribs:h.getConnectorAttribs,
pointClass:b,translate:g.translate});d.registerSeriesType("lollipop",a);"";return a});e(b,"masters/modules/lollipop.src.js",[],function(){})});
//# sourceMappingURL=lollipop.js.map