/*
 ** touch-sensitive.js
 ** Simulates mouse event for corresponding toach events.
 */

jQuery(function ($) {

	/* checking for existance of touch device  */
	if ($.support.touch) {

		/* *************************** Start of touch sensitive code ****************************** */
		var mouseProto = $.ui.mouse.prototype,
			_mouseInit = mouseProto._mouseInit,
			touchHandled;

		/*  Simulate a mouse event based on a corresponding touch event  */
		function simulateMouseEvent(event, simulatedType) {

			/* Ignore multi-touch events  */
			if (event.originalEvent.touches.length > 1) {
				return;
			}

			event.preventDefault();

			var touch = event.originalEvent.changedTouches[0],
				simulatedEvent = document.createEvent('MouseEvents');

			/* Initialize the simulated mouse event using the touch event's coordinates */
			simulatedEvent.initMouseEvent(
				simulatedType, /* type  */
				true, /* bubbles  */
				true, /* cancelable */
				window, /* view      */
				1, /* detail    */
				touch.screenX, /* screenX   */
				touch.screenY, /* screenY   */
				touch.clientX, /* clientX   */
				touch.clientY, /* clientY   */
				false, /* ctrlKey   */
				false, /* altKey    */
				false, /* shiftKey  */
				false, /* metaKey   */
				0, /* button    */
				null              /* relatedTarget   */
			);

			/* Dispatch the simulated event to the target element  */
			event.target.dispatchEvent(simulatedEvent);
		}

		/*	 Handle the jQuery UI widget's touchstart events	   */
		mouseProto._touchStart = function (event) {

			var self = this;

			/* Ignore the event if another widget is already being handled */
			if (touchHandled || !self._mouseCapture(event.originalEvent.changedTouches[0])) {
				return;
			}

			/* Set the flag to prevent other widgets from inheriting the touch event  */
			touchHandled = true;

			/* Track movement to determine if interaction was a click  */
			self._touchMoved = false;

			/* Simulate the mouseover event  */
			simulateMouseEvent(event, 'mouseover');

			/* Simulate the mousemove event  */
			simulateMouseEvent(event, 'mousemove');

			/* Simulate the mousedown event  */
			simulateMouseEvent(event, 'mousedown');
		};

		/* Handle the jQuery UI widget's touchmove events   */
		mouseProto._touchMove = function (event) {

			/* Ignore event if not handled */
			if (!touchHandled) {
				return;
			}

			/* Interaction was not a click */
			this._touchMoved = true;

			/* Simulate the mousemove event */
			simulateMouseEvent(event, 'mousemove');
		};

		/* Handle the jQuery UI widget's touchend events */
		mouseProto._touchEnd = function (event) {

			/* Ignore event if not handled */
			if (!touchHandled) {
				return;
			}

			/* Simulate the mouseup event */
			simulateMouseEvent(event, 'mouseup');

			/* Simulate the mouseout event */
			simulateMouseEvent(event, 'mouseout');

			/* If the touch interaction did not move, it should trigger a click  */
			if (!this._touchMoved) {

				/* Simulate the click event  */
				simulateMouseEvent(event, 'click');
			}

			/* Unset the flag to allow other widgets to inherit the touch event  */
			touchHandled = false;
		};

		/* Translating touch events to mouse events and passing them to the original mouse event handling methods.*/
		mouseProto._mouseInit = function () {

			var self = this;

			/* Delegate the touch handlers to the widget's element */
			self.element
				.bind('touchstart', $.proxy(self, '_touchStart'))
				.bind('touchmove', $.proxy(self, '_touchMove'))
				.bind('touchend', $.proxy(self, '_touchEnd'));

			/* Call the original $.ui.mouse init method */
			_mouseInit.call(self);
		};
	}
	/* *************************** End of touch sensitive code ****************************** */
});