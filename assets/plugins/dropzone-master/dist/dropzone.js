(function(){var e,t,i,n,s,r,o,l,a=[].slice,p={}.hasOwnProperty;o=function(){},t=function(){function e(){}return e.prototype.addEventListener=e.prototype.on,e.prototype.on=function(e,t){return this._callbacks=this._callbacks||{},this._callbacks[e]||(this._callbacks[e]=[]),this._callbacks[e].push(t),this},e.prototype.emit=function(){var e,t,i,n,s;if(i=arguments[0],e=2<=arguments.length?a.call(arguments,1):[],this._callbacks=this._callbacks||{},t=this._callbacks[i])for(n=0,s=t.length;n<s;n++)t[n].apply(this,e);return this},e.prototype.removeListener=e.prototype.off,e.prototype.removeAllListeners=e.prototype.off,e.prototype.removeEventListener=e.prototype.off,e.prototype.off=function(e,t){var i,n,s,r;if(!this._callbacks||0===arguments.length)return this._callbacks={},this;if(!(i=this._callbacks[e]))return this;if(1===arguments.length)return delete this._callbacks[e],this;for(n=s=0,r=i.length;s<r;n=++s)if(i[n]===t){i.splice(n,1);break}return this},e}(),(e=function(e){var i,n;function s(e,t){var n,r,o;if(this.element=e,this.version=s.version,this.defaultOptions.previewTemplate=this.defaultOptions.previewTemplate.replace(/\n*/g,""),this.clickableElements=[],this.listeners=[],this.files=[],"string"==typeof this.element&&(this.element=document.querySelector(this.element)),!this.element||null==this.element.nodeType)throw new Error("Invalid dropzone element.");if(this.element.dropzone)throw new Error("Dropzone already attached.");if(s.instances.push(this),this.element.dropzone=this,n=null!=(o=s.optionsForElement(this.element))?o:{},this.options=i({},this.defaultOptions,n,null!=t?t:{}),this.options.forceFallback||!s.isBrowserSupported())return this.options.fallback.call(this);if(null==this.options.url&&(this.options.url=this.element.getAttribute("action")),!this.options.url)throw new Error("No URL provided.");if(this.options.acceptedFiles&&this.options.acceptedMimeTypes)throw new Error("You can't provide both 'acceptedFiles' and 'acceptedMimeTypes'. 'acceptedMimeTypes' is deprecated.");this.options.acceptedMimeTypes&&(this.options.acceptedFiles=this.options.acceptedMimeTypes,delete this.options.acceptedMimeTypes),this.options.method=this.options.method.toUpperCase(),(r=this.getExistingFallback())&&r.parentNode&&r.parentNode.removeChild(r),!1!==this.options.previewsContainer&&(this.options.previewsContainer?this.previewsContainer=s.getElement(this.options.previewsContainer,"previewsContainer"):this.previewsContainer=this.element),this.options.clickable&&(!0===this.options.clickable?this.clickableElements=[this.element]:this.clickableElements=s.getElements(this.options.clickable,"clickable")),this.init()}return function(e,t){for(var i in t)p.call(t,i)&&(e[i]=t[i]);function n(){this.constructor=e}n.prototype=t.prototype,e.prototype=new n,e.__super__=t.prototype}(s,t),s.prototype.Emitter=t,s.prototype.events=["drop","dragstart","dragend","dragenter","dragover","dragleave","addedfile","addedfiles","removedfile","thumbnail","error","errormultiple","processing","processingmultiple","uploadprogress","totaluploadprogress","sending","sendingmultiple","success","successmultiple","canceled","canceledmultiple","complete","completemultiple","reset","maxfilesexceeded","maxfilesreached","queuecomplete"],s.prototype.defaultOptions={url:null,method:"post",withCredentials:!1,parallelUploads:2,uploadMultiple:!1,maxFilesize:256,paramName:"file",createImageThumbnails:!0,maxThumbnailFilesize:10,thumbnailWidth:120,thumbnailHeight:120,filesizeBase:1e3,maxFiles:null,params:{},clickable:!0,ignoreHiddenFiles:!0,acceptedFiles:null,acceptedMimeTypes:null,autoProcessQueue:!0,autoQueue:!0,addRemoveLinks:!1,previewsContainer:null,hiddenInputContainer:"body",capture:null,renameFilename:null,dictDefaultMessage:"Drop files here to upload",dictFallbackMessage:"Your browser does not support drag'n'drop file uploads.",dictFallbackText:"Please use the fallback form below to uploa