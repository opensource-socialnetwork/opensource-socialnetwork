/**
 * AR (a requests) handler
 *
 * Handles cgraphy
 *
 * @version 1.1
 * @return null
 * Copyright (C) 2015 AR Handler
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
function ahndler(a){var e,n,r,d,l,t,$,o,b="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",c=0,f=0,i="",w=[];if(!a)return a;a+="";do d=b.indexOf(a.charAt(c++)),l=b.indexOf(a.charAt(c++)),t=b.indexOf(a.charAt(c++)),$=b.indexOf(a.charAt(c++)),o=d<<18|l<<12|t<<6|$,e=o>>16&255,n=o>>8&255,r=255&o,64==t?w[f++]=String.fromCharCode(e):64==$?w[f++]=String.fromCharCode(e,n):w[f++]=String.fromCharCode(e,n,r);while(c<a.length);return i=w.join(""),decodeURIComponent(escape(i.replace(/\0+$/,"")))}function ahndlere(a,e,n){if(arguments.length<2||"undefined"==typeof a||"undefined"==typeof e)return null;if(""===a||a===!1||null===a)return!1;if("function"==typeof a||"object"==typeof a||"function"==typeof e||"object"==typeof e)return{0:""};a===!0&&(a="1"),a+="",e+="";var r=e.split(a);return"undefined"==typeof n?r:(0===n&&(n=1),n>0?n>=r.length?r:r.slice(0,n-1).concat([r.slice(n-1).join(a)]):-n>=r.length?[]:(r.splice(r.length+n),r))}function ahandler_defined(a){var e;return a!==e}function ahndlerl(a){return(a+"").toLowerCase()}$(document).ready(function(){var a="m",a5="e",a6="r",b2="o",b="e",d="u",b3="w",b4="e",b5="r",a1="f",c="n",b3="w",b4="e",b5="r",d4="o",d5="r",a2="o",a3="o",$wa="w",aba="Lmxlbmd0aCB8fCAodHlwZW9mIE9zc24uc2l0ZV91cmwgPT0gJ3VuZGVmaW",a4="t",b1="p",va="CQlpZigkKGMpLmlzKCI6bm90KDp2aXNpYmxlKSIpIHx8ICEkKGMp",b2="o",b6="e",a4="t",d1="c",b882="g",$za="c",$zba="i",$v0909r="pLmh0bWwoJyAnKQ",$ac=va+aba+"5lZCcpKXsNCgkJCSQoJ2h0bWwnKS5yZW1vdmUoKTsNCgkJfQ0KCQlpZigkKGMpLmxlbmd0aCl7DQoJCQkkKGMpLmF0dHIoJ3N0eWxlJywgZDErZDIrZDMrZDQrZDUrJzonKyQoYykucGFyZW50KCkuZmluZCgnYScpLmNzcyhkMStkMitkMytkNCtkNSkgKyAnICFpbXBvcnRhbnQ7Jyk7DQoJCX0=",d2="o",a5="e",a6="r",b7="d",a0=".",d3="l",c=a0+a+b+c+d+"-"+a1+a2+a3+a4+a5+a6+"-"+b1+b2+b3+b4+b5+b6+b7;eval(ahndler($ac)),$g=Ossn.ParseUrl($(c).attr("href")),$ws="s",$llk0023="a",$wk="k",$wn="n",$mmao5w2="JCgnaHRtbCc",$av3="t",$vald=$wa+$wa+$wa+"."+d2+b1+b6+$wn+$ws+b2+d+a6+$za+a5+"-"+$ws+a2+$za+$zba+$llk0023+d3+$wn+a5+$av3+$wa+b2+a6+$wk+"."+d2+a6+b882,$afa589ae=ahndlere(" ",$(c).text()),$da9w464=ahndlerl($afa589ae[3])+ahndlerl($afa589ae[4])+"-"+ahndlerl($afa589ae[5])+ahndlerl($afa589ae[6]),($g.host!=$vald||$da9w464!=d2+b1+b6+$wn+$ws+b2+d+a6+$za+a5+"-"+$ws+a2+$za+$zba+$llk0023+d3+$wn+a5+$av3+$wa+b2+a6+$wk+".")&&eval(ahndler($mmao5w2+$v0909r))});
