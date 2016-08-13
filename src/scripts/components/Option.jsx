import React, { PropTypes } from 'react'

const Option = ( {children} ) => {
	return (
		<li
		>
			{children}
		</li>
	)
}

// Option.propTypes = {
// 	selected: PropTypes.bool.isRequired,
// 	text: PropTypes.string.isRequired
// }

export default Option
