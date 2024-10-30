(function ($, w) {
    var $window = $(w);

  function debounce(fc, wait, immediate) {
      
    var timeout;
        
    return function() 
    {
          var context = this, args = arguments;
           
          var later = function() {
            
            timeout = null;
           
            if (!immediate) fc.apply(context, args);
           
        };
           
        var callNow = immediate && !timeout;
           
        clearTimeout(timeout);
           
        timeout = setTimeout(later, wait);
           
        if (callNow) fc.apply(context, args);
        };
    }


    $window.on('elementor/frontend/init', function() {
       
        var ExtendFloat = elementorModules.frontend.handlers.Base.extend({
           
            onInit: function() {
                
                elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
                
                this.container = this.$element.find('.elementor-widget-container')[0];

                this.initFloatEffect();

            },



            getDefaultSettings: function() {
                return {
                    targets: this.container,
                    loop: true,
                    direction: 'alternate',
                    easing: 'easeInOutSine',
                };
            },

            onElementChange: function(randomchange) {
               
                if (randomchange.indexOf('me_floating') !== -1) {
                    this.runOnElementChange();
                }

            },

            runOnElementChange: debounce(function() {
                
                this.animation && this.animation.restart();
                this.initFloatEffect();

            }, 200),

           
            getConfig: function(key) {
                
                return this.getElementSettings('me_floating_effects_' + key);
            },

            initFloatEffect: function() {
                var config = this.getDefaultSettings();

                if (this.getConfig('translate_toggle')) {
                   
                    if (this.getConfig('translate_x.size') || this.getConfig('translate_x.sizes.to')) {
                       
                        config.translateX = {
                           
                            value: [this.getConfig('translate_x.sizes.from') || 0, this.getConfig('translate_x.size') || this.getConfig('translate_x.sizes.to')],
                            
                            duration: this.getConfig('translate_duration.size'),
                            
                            delay: this.getConfig('translate_delay.size') || 0
                       
                        }
                    }
                    if (this.getConfig('translate_y.size') || this.getConfig('translate_y.sizes.to')) {
                       
                        config.translateY = {
                           
                            value: [this.getConfig('translate_y.sizes.from') || 0, this.getConfig('translate_y.size') || this.getConfig('translate_y.sizes.to')],
                           
                            duration: this.getConfig('translate_duration.size'),
                           
                            delay: this.getConfig('translate_delay.size') || 0
                       
                        }
                    }
                }

                if (this.getConfig('rotate_toggle')) {

                    if (this.getConfig('rotate_x.size') || this.getConfig('rotate_x.sizes.to')) {

                        config.rotateX = {
                           
                            value: [this.getConfig('rotate_x.sizes.from') || 0, this.getConfig('rotate_x.size') || this.getConfig('rotate_x.sizes.to')],
                           
                            duration: this.getConfig('rotate_duration.size'),
                            
                            delay: this.getConfig('rotate_delay.size') || 0
                        }
                    }
                    if (this.getConfig('rotate_y.size') || this.getConfig('rotate_y.sizes.to')) {
                        
                        config.rotateY = {
                           
                            value: [this.getConfig('rotate_y.sizes.from') || 0, this.getConfig('rotate_y.size') || this.getConfig('rotate_y.sizes.to')],
                            
                            duration: this.getConfig('rotate_duration.size'),
                            
                            delay: this.getConfig('rotate_delay.size') || 0
                        }
                    }
                    if (this.getConfig('rotate_z.size') || this.getConfig('rotate_z.sizes.to')) {
                        
                        config.rotateZ = {
                            
                            value: [this.getConfig('rotate_z.sizes.from') || 0, this.getConfig('rotate_z.size') || this.getConfig('rotate_z.sizes.to')],
                            
                            duration: this.getConfig('rotate_duration.size'),
                            
                            delay: this.getConfig('rotate_delay.size') || 0
                        }
                    }
                }

                if (this.getConfig('scale_toggle')) {
                    if (this.getConfig('scale_x.size') || this.getConfig('scale_x.sizes.to')) {
                        
                        config.scaleX = {
                           
                            value: [this.getConfig('scale_x.sizes.from') || 0, this.getConfig('scale_x.size') || this.getConfig('scale_x.sizes.to')],
                            
                            duration: this.getConfig('scale_duration.size'),
                            
                            delay: this.getConfig('scale_delay.size') || 0
                        }
                    }
                    if (this.getConfig('scale_y.size') || this.getConfig('scale_y.sizes.to')) {
                        
                        config.scaleY = {
                           
                            value: [this.getConfig('scale_y.sizes.from') || 0, this.getConfig('scale_y.size') || this.getConfig('scale_y.sizes.to')],
                            
                            duration: this.getConfig('scale_duration.size'),
                           
                            delay: this.getConfig('scale_delay.size') || 0
                        }
                    }
                }

                if (this.getConfig('translate_toggle') || this.getConfig('rotate_toggle') || this.getConfig('scale_toggle'))
                 {
                    
                    this.container.style.setProperty('will-change', 'transform');
                   
                    this.animation = anime(config);
                }
            }
        });

        $('[me-floatelement-link]').each(function() 
        {
            var link = $(this).data('me-floatelement-link');
           
            $(this).on('click.meFloatElementOnClick', function() {
              
                if (link.is_external) {
              
                    window.open(link.url);
               
                } 
                else
                 {
                    location.href = link.url;
                }
            })
        });


        var handlersClassMap = {
            
            'widget': ExtendFloat

        };

        $.each( handlersClassMap, function( widgetName, handlerClass ) 
        {
          
            elementorFrontend.hooks.addAction( 'frontend/element_ready/' + widgetName, function( $scope ) {
             
                elementorFrontend.elementsHandler.addHandler( handlerClass, { $element: $scope });
           
            });
        });
    });

} (jQuery, window));
