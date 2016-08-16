import React, { PropTypes } from 'react'

const Option = ( {children, onClick} ) => {
	return (
		<li onClick={onClick}
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
